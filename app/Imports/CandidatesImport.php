<?php

namespace App\Imports;

use App\Models\Candidate;
use App\Models\ElectionPosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CandidatesImport implements
    ToCollection,
    WithHeadingRow
{
    protected int $electionId;

    protected array $results = [
        'total' => 0,
        'success' => 0,
        'failed' => 0,
        'duplicates' => 0,
        'errors' => [],
    ];

    /**
     * Validated rows waiting for import.
     */
    protected array $validRows = [];

    /**
     * Slugs already reserved during this import.
     */
    protected array $reservedSlugs = [];

    public function __construct(int $electionId)
    {
        $this->electionId = $electionId;
    }

    /**
     * Process spreadsheet.
     *
     * IMPORTANT:
     * We validate the COMPLETE spreadsheet first.
     * Nothing is inserted until every row passes validation.
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

            $name = trim((string) ($row['name'] ?? ''));

            $positionName = trim(
                (string) ($row['position'] ?? '')
            );

            $bio = trim(
                (string) ($row['bio'] ?? '')
            );

            /*
            |--------------------------------------------------------------------------
            | Empty row
            |--------------------------------------------------------------------------
            */

            if (
                $name === '' &&
                $positionName === '' &&
                $bio === ''
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
                    'Candidate name is required.'
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | POSITION
            |--------------------------------------------------------------------------
            */

            if ($positionName === '') {

                $this->fail(
                    $rowNumber,
                    'Position is required.'
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | FIND POSITION
            |--------------------------------------------------------------------------
            */

            $position = ElectionPosition::query()
                ->where('election_id', $this->electionId)
                ->whereRaw(
                    'LOWER(TRIM(name)) = ?',
                    [strtolower($positionName)]
                )
                ->first();

            if (!$position) {

                $this->fail(
                    $rowNumber,
                    "Position '{$positionName}' does not exist in the selected election."
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE IN DATABASE
            |--------------------------------------------------------------------------
            */

            $duplicate = Candidate::query()
                ->where('election_id', $this->electionId)
                ->where(
                    'election_position_id',
                    $position->id
                )
                ->whereRaw(
                    'LOWER(TRIM(name)) = ?',
                    [strtolower($name)]
                )
                ->exists();

            if ($duplicate) {

                $this->results['duplicates']++;

                $this->results['errors'][] = [
                    'row' => $rowNumber,
                    'type' => 'duplicate',
                    'message' =>
                        "Candidate '{$name}' already exists in {$position->name}.",
                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE INSIDE THE SAME EXCEL FILE
            |--------------------------------------------------------------------------
            */

            $duplicateKey =
                $position->id . '|' . strtolower($name);

            if (isset($this->validRows[$duplicateKey])) {

                $this->results['duplicates']++;

                $this->results['errors'][] = [
                    'row' => $rowNumber,
                    'type' => 'duplicate',
                    'message' =>
                        "Candidate '{$name}' appears more than once in the spreadsheet for {$position->name}.",
                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | SLUG
            |--------------------------------------------------------------------------
            */

            $slug = $this->generateUniqueSlug($name);

            /*
            |--------------------------------------------------------------------------
            | STORE VALIDATED ROW
            |--------------------------------------------------------------------------
            */

            $this->validRows[$duplicateKey] = [
                'row' => $rowNumber,
                'election_id' => $this->electionId,
                'election_position_id' => $position->id,
                'name' => $name,
                'slug' => $slug,
                'bio' => $bio !== '' ? $bio : null,
                'photo' => null,
                'status' => true,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | IF ANY VALIDATION ERROR EXISTS — DO NOT IMPORT ANYTHING
        |--------------------------------------------------------------------------
        */

        if (!empty($this->results['errors'])) {

            $this->results['success'] = 0;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | PHASE 2 — ATOMIC DATABASE INSERT
        |--------------------------------------------------------------------------
        */

        if (empty($this->validRows)) {
            return;
        }

        DB::transaction(function () {

            foreach ($this->validRows as $candidate) {

                Candidate::create([
                    'election_id' =>
                        $candidate['election_id'],

                    'election_position_id' =>
                        $candidate['election_position_id'],

                    'name' =>
                        $candidate['name'],

                    'slug' =>
                        $candidate['slug'],

                    'photo' =>
                        $candidate['photo'],

                    'bio' =>
                        $candidate['bio'],

                    'status' =>
                        $candidate['status'],
                ]);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        $this->results['success'] =
            count($this->validRows);
    }

    /**
     * Generate a slug that is unique both in the database
     * and inside the current import.
     */
    protected function generateUniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            $baseSlug = 'candidate';
        }

        $slug = $baseSlug;

        $counter = 2;

        while (
            Candidate::where('slug', $slug)->exists()
            || in_array($slug, $this->reservedSlugs, true)
        ) {

            $slug =
                $baseSlug .
                '-' .
                $counter;

            $counter++;
        }

        $this->reservedSlugs[] = $slug;

        return $slug;
    }

    /**
     * Record validation failure.
     */
    protected function fail(
        int $row,
        string $message
    ): void {

        $this->results['failed']++;

        $this->results['errors'][] = [
            'row' => $row,
            'type' => 'validation',
            'message' => $message,
        ];
    }

    /**
     * Return import results.
     */
    public function results(): array
    {
        return $this->results;
    }
}