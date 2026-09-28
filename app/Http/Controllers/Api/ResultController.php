<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function show(Request $request, Election $election): JsonResponse
    {
        $user = $request->user();

        $voter = $user->voter;

        if (!$voter) {
            return response()->json([
                'success' => false,
                'message' => 'Voter profile not found.',
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Confirm voter has access to this election
        |--------------------------------------------------------------------------
        */

        $electionVoter = $election->voters()
    ->where('voters.id', $voter->id)
    ->first();

        if (!$electionVoter) {
            return response()->json([
                'success' => false,
                'message' => 'You are not registered for this election.',
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Respect election result visibility
        |--------------------------------------------------------------------------
        */

        if (!$election->show_live_results) {
            return response()->json([
                'success' => false,
                'message' => 'Results are not currently available for this election.',
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Get submitted ballots
        |--------------------------------------------------------------------------
        */

        $submittedBallotIds = $election->ballots()
            ->where('status', 'submitted')
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Build position results
        |--------------------------------------------------------------------------
        */

        $positions = $election->positions()
            ->orderBy('sort_order')
            ->get()
            ->map(function ($position) use ($submittedBallotIds) {

                $results = DB::table('ballot_selections')
                    ->join(
                        'candidates',
                        'candidates.id',
                        '=',
                        'ballot_selections.candidate_id'
                    )
                    ->where(
                        'ballot_selections.election_position_id',
                        $position->id
                    )
                    ->whereIn(
                        'ballot_selections.ballot_id',
                        $submittedBallotIds
                    )
                    ->select(
                        'candidates.id as candidate_id',
                        'candidates.name as candidate_name',
                        'candidates.photo as candidate_photo',
                        DB::raw('COUNT(ballot_selections.id) as votes')
                    )
                    ->groupBy(
                        'candidates.id',
                        'candidates.name',
                        'candidates.photo'
                    )
                    ->orderByDesc('votes')
                    ->get();

                return [
                    'position_id' => $position->id,
                    'position' => $position->name,
                    'description' => $position->description,
                    'total_votes' => $results->sum('votes'),

                    'candidates' => $results->map(function ($result) {
                        return [
                            'candidate_id' => $result->candidate_id,
                            'candidate' => $result->candidate_name,
                            'candidate_photo' => $result->candidate_photo,
                            'votes' => (int) $result->votes,
                        ];
                    })->values(),
                ];
            })->values();

        return response()->json([
            'success' => true,
            'election' => [
                'id' => $election->id,
                'title' => $election->title,
                'slug' => $election->slug,
                'starts_at' => $election->starts_at,
                'ends_at' => $election->ends_at,
            ],
            'positions' => $positions,
        ]);
    }
}