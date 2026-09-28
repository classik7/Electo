<?php

namespace App\Imports;

use App\Models\ElectionVoter;
use App\Models\Voter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VotersImport implements
    ToCollection,
    WithHeadingRow
{
    protected int $electionId;

    protected array $results = [
        'total' => 0,
        'success' => 0,
        'new_voters' => 0,
        'existing_voters' => 0,
        'failed' => 0,
        'duplicates' => 0,
        'errors' => [],
    ];

    protected array $validRows = [];

    protected array $seenVoters = [];

    public function __construct(int $electionId)
    {
        $this->electionId = $electionId;
    }

    /*
    |--------------------------------------------------------------------------
    | Process Spreadsheet
    |--------------------------------------------------------------------------
    */

    public function collection(Collection $rows): void
    {
        $this->results['total'] = $rows->count();

        /*
        |--------------------------------------------------------------------------
        | PHASE 1 — VALIDATE EVERYTHING
        |--------------------------------------------------------------------------
        */

        foreach ($rows as $index => $row) {

            $rowNumber = $index + 2;

            $name = trim(
                (string) ($row['name'] ?? '')
            );

            $voterId = trim(
                (string) ($row['voter_id'] ?? '')
            );

            $email = strtolower(
                trim(
                    (string) ($row['email'] ?? '')
                )
            );

            $phone = trim(
                (string) ($row['phone'] ?? '')
            );

            /*
            |--------------------------------------------------------------------------
            | Ignore completely empty rows
            |--------------------------------------------------------------------------
            */

            if (
                $name === '' &&
                $voterId === '' &&
                $email === '' &&
                $phone === ''
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | NAME
            |--------------------------------------------------------------------------
            */

            if ($name === '') {

                $this->fail(
                    $rowNumber,
                    'Voter name is required.'
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | VOTER ID
            |--------------------------------------------------------------------------
            */

            if ($voterId === '') {

                $this->fail(
                    $rowNumber,
                    'Voter ID is required.'
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | EMAIL
            |--------------------------------------------------------------------------
            */

            if (
                $email !== '' &&
                !filter_var($email, FILTER_VALIDATE_EMAIL)
            ) {

                $this->fail(
                    $rowNumber,
                    "Invalid email address '{$email}'."
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | PHONE
            |--------------------------------------------------------------------------
            */

            if ($phone === '') {

                $this->fail(
                    $rowNumber,
                    'Phone number is required.'
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE INSIDE EXCEL
            |--------------------------------------------------------------------------
            */

            $sheetKey = strtolower($voterId);

            if (isset($this->seenVoters[$sheetKey])) {

                $this->results['duplicates']++;

                $this->results['errors'][] = [
                    'row' => $rowNumber,
                    'type' => 'duplicate',
                    'message' =>
                        "Voter ID '{$voterId}' appears more than once in the spreadsheet.",
                ];

                continue;
            }

            $this->seenVoters[$sheetKey] = true;

            /*
            |--------------------------------------------------------------------------
            | FIND EXISTING VOTER
            |--------------------------------------------------------------------------
            */

            $voter = Voter::query()
                ->where('voter_id', $voterId)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | EMAIL MATCH
            |--------------------------------------------------------------------------
            */

            if (!$voter && $email !== '') {

                $voter = Voter::query()
                    ->whereRaw(
                        'LOWER(email) = ?',
                        [$email]
                    )
                    ->first();
            }

            /*
            |--------------------------------------------------------------------------
            | PHONE MATCH
            |--------------------------------------------------------------------------
            */

            if (!$voter && $phone !== '') {

                $voter = Voter::query()
                    ->where('phone', $phone)
                    ->first();
            }

            /*
            |--------------------------------------------------------------------------
            | EXISTING VOTER — CHECK ELECTION
            |--------------------------------------------------------------------------
            */

            if ($voter) {

                $alreadyAssigned =
                    ElectionVoter::query()
                        ->where(
                            'election_id',
                            $this->electionId
                        )
                        ->where(
                            'voter_id',
                            $voter->id
                        )
                        ->exists();

                if ($alreadyAssigned) {

                    $this->results['duplicates']++;

                    $this->results['errors'][] = [
                        'row' => $rowNumber,
                        'type' => 'duplicate',
                        'message' =>
                            "Voter '{$voter->name}' is already assigned to this election.",
                    ];

                    continue;
                }

                $this->results['existing_voters']++;

            } else {

                /*
                |--------------------------------------------------------------------------
                | NEW VOTER
                |--------------------------------------------------------------------------
                */

                /*
                | Make sure voter ID does not already belong
                | to another voter.
                */

                $voterIdExists =
                    Voter::query()
                        ->where(
                            'voter_id',
                            $voterId
                        )
                        ->exists();

                if ($voterIdExists) {

                    $this->fail(
                        $rowNumber,
                        "Voter ID '{$voterId}' is already in use."
                    );

                    continue;
                }

                $this->results['new_voters']++;
            }

            /*
            |--------------------------------------------------------------------------
            | Store validated row
            |--------------------------------------------------------------------------
            */

            $this->validRows[] = [
                'row' => $rowNumber,
                'voter' => $voter,
                'name' => $name,
                'voter_id' => $voterId,
                'email' => $email !== ''
                    ? $email
                    : null,
                'phone' => $phone,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | DO NOT IMPORT PARTIAL FILES
        |--------------------------------------------------------------------------
        */

        if (!empty($this->results['errors'])) {

            $this->results['success'] = 0;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | PHASE 2 — ATOMIC IMPORT
        |--------------------------------------------------------------------------
        */

        if (empty($this->validRows)) {
            return;
        }

        DB::transaction(function () {

            foreach ($this->validRows as $row) {

                $voter = $row['voter'];

                /*
                |--------------------------------------------------------------------------
                | Create new voter when necessary
                |--------------------------------------------------------------------------
                */

                if (!$voter) {

                    $voter = Voter::create([

                        'user_id' => null,

                        'name' =>
                            $row['name'],

                        'voter_id' =>
                            $row['voter_id'],

                        'email' =>
                            $row['email'],

                        'phone' =>
                            $row['phone'],

                        'photo' =>
                            null,

                        'status' =>
                            'active',

                        'verified_at' =>
                            null,

                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Create election participation
                |--------------------------------------------------------------------------
                */

                ElectionVoter::create([

                    'election_id' =>
                        $this->electionId,

                    'voter_id' =>
                        $voter->id,

                    'is_eligible' =>
                        true,

                    'accreditation_status' =>
                        'pending',

                    'accredited_at' =>
                        null,

                    'accredited_by' =>
                        null,

                    'accreditation_method' =>
                        null,

                    'accreditation_reference' =>
                        null,

                    'has_voted' =>
                        false,

                    'voted_at' =>
                        null,

                ]);
            }
        });

        $this->results['success'] =
            count($this->validRows);
    }

    /*
    |--------------------------------------------------------------------------
    | Record Failure
    |--------------------------------------------------------------------------
    */

    protected function fail(
        int $row,
        string $message
    ): void {

        $this->results['failed']++;

        $this->results['errors'][] = [

            'row' =>
                $row,

            'type' =>
                'validation',

            'message' =>
                $message,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Results
    |--------------------------------------------------------------------------
    */

    public function results(): array
    {
        return $this->results;
    }
}