<?php

namespace App\Http\Controllers;

use App\Exports\CandidateTemplateExport;
use App\Imports\CandidatesImport;
use App\Models\CandidateImportBatch;
use App\Models\Election;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CandidateImportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Import Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $elections = Election::query()

            ->orderBy(
                'title'
            )

            ->get([
                'id',
                'title',
                'status',
                'starts_at',
                'ends_at',
            ]);


        return view(
            'electo.candidates.import',
            compact(
                'elections'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Download Template
    |--------------------------------------------------------------------------
    */

    public function template(
        Request $request
    ) {

        $electionId =
            $request->integer(
                'election_id'
            );


        if (!$electionId) {

            return back()->with(
                'error',
                'Please select an election first.'
            );

        }


        $election =
            Election::findOrFail(
                $electionId
            );


        return Excel::download(
            new CandidateTemplateExport(
                $election
            ),
            'candidate-import-template.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Import Candidates
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
{
    $validated = $request->validate([

        'election_id' => [
            'required',
            'integer',
            'exists:elections,id',
        ],

        'file' => [
            'required',
            'file',
            'mimes:xlsx,xls,csv',
            'max:10240',
        ],

    ]);

    $election = Election::findOrFail(
        $validated['election_id']
    );

    /*
    |--------------------------------------------------------------------------
    | CREATE IMPORT BATCH
    |--------------------------------------------------------------------------
    */

    $batch = CandidateImportBatch::create([

        'election_id' =>
            $election->id,

        'imported_by' =>
            auth()->id(),

        'file_name' =>
            $request
                ->file('file')
                ->getClientOriginalName(),

        'file_type' =>
            $request
                ->file('file')
                ->getClientOriginalExtension(),

        'status' =>
            'processing',

    ]);

    try {

        /*
        |--------------------------------------------------------------------------
        | RUN IMPORT
        |--------------------------------------------------------------------------
        */

        $import = new CandidatesImport(
            $election->id
        );

        Excel::import(
            $import,
            $request->file('file')
        );

        /*
        |--------------------------------------------------------------------------
        | RESULTS
        |--------------------------------------------------------------------------
        */

        $results = $import->results();

        $hasErrors =
            !empty($results['errors']);

        /*
        |--------------------------------------------------------------------------
        | UPDATE BATCH
        |--------------------------------------------------------------------------
        */

        $batch->update([

            'total_rows' =>
                $results['total'],

            'successful_rows' =>
                $results['success'],

            'failed_rows' =>
                $results['failed'],

            'duplicate_rows' =>
                $results['duplicates'],

            'errors' =>
                $results['errors'],

            'status' =>
                $hasErrors
                    ? 'failed'
                    : 'completed',

            'completed_at' =>
                now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | RETURN RESULTS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'import_results',
            [
                'batch' =>
                    $batch,

                'results' =>
                    $results,

                'election' =>
                    $election,
            ]
        );

    } catch (\Throwable $exception) {

        /*
        |--------------------------------------------------------------------------
        | MARK BATCH FAILED
        |--------------------------------------------------------------------------
        */

        $batch->update([

            'status' =>
                'failed',

            'errors' => [
                [
                    'row' =>
                        null,

                    'type' =>
                        'system',

                    'message' =>
                        $exception->getMessage(),
                ],
            ],

            'completed_at' =>
                now(),

        ]);

        report($exception);

        return back()->with(
            'error',
            'The candidate import failed. No candidates were imported.'
        );
    }
}
}