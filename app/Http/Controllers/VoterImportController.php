<?php

namespace App\Http\Controllers;

use App\Exports\VoterTemplateExport;
use App\Imports\VotersImport;
use App\Models\Election;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VoterImportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Import Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $elections = Election::query()
            ->orderBy('title')
            ->get([
                'id',
                'title',
                'status',
                'starts_at',
                'ends_at',
            ]);

        return view(
            'electo.voters.import',
            compact('elections')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Download Template
    |--------------------------------------------------------------------------
    */

    public function template(Request $request)
    {
        $electionId =
            $request->integer('election_id');

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
            new VoterTemplateExport(
                $election
            ),
            'voter-import-template.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Import Voters
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated =
            $request->validate([

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

        $election =
            Election::findOrFail(
                $validated['election_id']
            );

        try {

            /*
            |--------------------------------------------------------------------------
            | Run Import
            |--------------------------------------------------------------------------
            */

            $import =
                new VotersImport(
                    $election->id
                );

            Excel::import(
                $import,
                $request->file('file')
            );

            /*
            |--------------------------------------------------------------------------
            | Results
            |--------------------------------------------------------------------------
            */

            $results =
                $import->results();

            $hasErrors =
                !empty($results['errors']);

            /*
            |--------------------------------------------------------------------------
            | Return Report
            |--------------------------------------------------------------------------
            */

            return back()->with(
                'import_results',
                [

                    'results' =>
                        $results,

                    'election' =>
                        $election,

                ]
            );

        } catch (\Throwable $exception) {

            report($exception);

            return back()->with(
                'error',
                'The voter import failed. No voters were imported.'
            );
        }
    }
}