<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Ballot;
use App\Models\Candidate;
use App\Models\ElectionPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{	
/**
 * Display available elections for results.
 */
public function index()
{
    $elections = Election::query()
        ->orderByDesc('created_at')
        ->get();

    return view(
        'electo.results.index',
        compact('elections')
    );
}

    /**
     * Display results for an election.
     */
    public function show(Election $election)
    {
        /*
        |--------------------------------------------------------------------------
        | Get submitted ballots only
        |--------------------------------------------------------------------------
        |
        | Draft and void ballots must never contribute to election results.
        |
        */

        $submittedBallots = Ballot::where(
            'election_id',
            $election->id
        )
        ->where(
            'status',
            'submitted'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | Get Election Positions
        |--------------------------------------------------------------------------
        */

        $positions = ElectionPosition::where(
            'election_id',
            $election->id
        )
        ->orderBy(
            'sort_order'
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Build Results
        |--------------------------------------------------------------------------
        */

        $results = [];


        foreach ($positions as $position) {

            /*
            |--------------------------------------------------------------------------
            | Candidates for this position
            |--------------------------------------------------------------------------
            */

            $candidates = Candidate::where(
                'election_id',
                $election->id
            )
            ->where(
                'election_position_id',
                $position->id
            )
            ->where(
                'status',
                1
            )
            ->get();


            /*
            |--------------------------------------------------------------------------
            | Calculate Votes
            |--------------------------------------------------------------------------
            */

            $candidateResults = $candidates->map(function ($candidate) use ($election) {

                $votes = DB::table('ballot_selections')
                    ->join(
                        'ballots',
                        'ballot_selections.ballot_id',
                        '=',
                        'ballots.id'
                    )
                    ->where(
                        'ballots.election_id',
                        $election->id
                    )
                    ->where(
                        'ballots.status',
                        'submitted'
                    )
                    ->where(
                        'ballot_selections.candidate_id',
                        $candidate->id
                    )
                    ->count();


                return [
                    'candidate' => $candidate,
                    'votes' => $votes,
                ];
            });


            /*
            |--------------------------------------------------------------------------
            | Sort Candidates
            |--------------------------------------------------------------------------
            */

            $candidateResults = $candidateResults
                ->sortByDesc('votes')
                ->values();


            /*
            |--------------------------------------------------------------------------
            | Determine Winner
            |--------------------------------------------------------------------------
            */

            $winner = null;

            if (
                $candidateResults->isNotEmpty() &&
                $candidateResults->first()['votes'] > 0
            ) {
                $winner = $candidateResults->first();
            }


            /*
            |--------------------------------------------------------------------------
            | Add Position Results
            |--------------------------------------------------------------------------
            */

            $results[] = [
                'position' => $position,

                'candidates' => $candidateResults,

                'winner' => $winner,

                'total_votes' => $candidateResults->sum('votes'),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Election Statistics
        |--------------------------------------------------------------------------
        */

        $totalCandidates = Candidate::where(
            'election_id',
            $election->id
        )
        ->where(
            'status',
            1
        )
        ->count();

		/*
|--------------------------------------------------------------------------
| Winners Summary
|--------------------------------------------------------------------------
*/

$winners = collect($results)
    ->filter(function ($result) {
        return !is_null($result['winner']);
    })
    ->map(function ($result) {

        return [
            'position' => $result['position'],
            'candidate' => $result['winner']['candidate'],
            'votes' => $result['winner']['votes'],
        ];

    })
    ->values();
	
	
        /*
        |--------------------------------------------------------------------------
        | Render Results
        |--------------------------------------------------------------------------
        */

        return view(
            'electo.results.show',
            compact(
                'election',
                'submittedBallots',
                'totalCandidates',
                'positions',
                'results',
				'winners'
            )
        );
    }
}