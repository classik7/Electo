<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Get elections assigned to the authenticated voter.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $voter = $user->voter;

        if (!$voter) {
            return response()->json([
                'success' => false,
                'message' => 'No voter profile is linked to this account.',
                'elections' => [],
            ], 403);
        }

        $electionVoters = $voter
            ->electionVoters()
            ->with('election')
            ->get();

        $elections = $electionVoters
            ->filter(fn ($electionVoter) => $electionVoter->election !== null)
            ->map(function ($electionVoter) {

                $election = $electionVoter->election;

                $status = $this->getElectionStatus($election);

                return [
                    'id' => $election->id,
                    'title' => $election->title,
                    'slug' => $election->slug,
                    'description' => $election->description,
                    'logo' => $election->logo,
                    'banner' => $election->banner,
                    'starts_at' => $election->starts_at,
                    'ends_at' => $election->ends_at,

                    'status' => $status,

                    'is_eligible' =>
                        (bool) $electionVoter->is_eligible,

                    'accreditation_status' =>
                        $electionVoter->accreditation_status,

                    'accredited_at' =>
                        $electionVoter->accredited_at,

                    'has_voted' =>
                        (bool) $electionVoter->has_voted,

                    'voted_at' =>
                        $electionVoter->voted_at,

                    'can_vote' =>
                        (bool) $electionVoter->is_eligible
                        &&
                        !$electionVoter->has_voted
                        &&
                        $status === 'open',
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'message' => 'Elections retrieved successfully.',

            'voter' => [
                'id' => $voter->id,
                'name' => $voter->name,
                'voter_id' => $voter->voter_id,
            ],

            'total' => $elections->count(),

            'elections' => $elections,
        ]);
    }


    /**
     * Get one election with its positions and candidates.
     */
    public function show(
        Request $request,
        Election $election
    ): JsonResponse {

        $user = $request->user();

        $voter = $user->voter;

        if (!$voter) {
            return response()->json([
                'success' => false,
                'message' => 'No voter profile is linked to this account.',
            ], 403);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify that this voter is assigned to this election
        |--------------------------------------------------------------------------
        */

        $electionVoter = $voter
            ->electionVoters()
            ->where('election_id', $election->id)
            ->first();


        if (!$electionVoter) {

            return response()->json([
                'success' => false,
                'message' => 'You are not assigned to this election.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Election Status
        |--------------------------------------------------------------------------
        */

        $status = $this->getElectionStatus($election);


        /*
        |--------------------------------------------------------------------------
        | Load Positions + Active Candidates
        |--------------------------------------------------------------------------
        */

        $election->load([
            'positions.candidates' => function ($query) {
                $query
                    ->where('status', 1)
                    ->orderBy('name');
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | Format Positions
        |--------------------------------------------------------------------------
        */

        $positions = $election->positions
            ->map(function ($position) {

                return [
                    'id' =>
                        $position->id,

                    'name' =>
                        $position->name,

                    'description' =>
                        $position->description,

                    'sort_order' =>
                        $position->sort_order,

                    'candidates' =>
                        $position->candidates
                            ->map(function ($candidate) {

                                return [
                                    'id' =>
                                        $candidate->id,

                                    'name' =>
                                        $candidate->name,

                                    'slug' =>
                                        $candidate->slug,

                                    'photo' =>
                                        $candidate->photo,

                                    'bio' =>
                                        $candidate->bio,

                                    'status' =>
                                        (bool) $candidate->status,

                                ];

                            })
                            ->values(),
                ];

            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Return Election
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'message' =>
                'Election details retrieved successfully.',

            'election' => [

                'id' =>
                    $election->id,

                'title' =>
                    $election->title,

                'slug' =>
                    $election->slug,

                'description' =>
                    $election->description,

                'logo' =>
                    $election->logo,

                'banner' =>
                    $election->banner,

                'starts_at' =>
                    $election->starts_at,

                'ends_at' =>
                    $election->ends_at,

                'status' =>
                    $status,

                'allow_multiple_votes' =>
                    (bool) $election->allow_multiple_votes,

                'show_live_results' =>
                    (bool) $election->show_live_results,

                'require_voter_verification' =>
                    (bool) $election->require_voter_verification,

            ],

            'voter' => [

                'id' =>
                    $voter->id,

                'name' =>
                    $voter->name,

                'voter_id' =>
                    $voter->voter_id,

                'is_eligible' =>
                    (bool) $electionVoter->is_eligible,

                'accreditation_status' =>
                    $electionVoter->accreditation_status,

                'accredited_at' =>
                    $electionVoter->accredited_at,

                'has_voted' =>
                    (bool) $electionVoter->has_voted,

                'voted_at' =>
                    $electionVoter->voted_at,

            ],

            'can_vote' =>
                (bool) $electionVoter->is_eligible
                &&
                !$electionVoter->has_voted
                &&
                $status === 'open',

            'positions' =>
                $positions,

        ]);
    }


    /**
     * Determine current election status.
     */
    protected function getElectionStatus(
        Election $election
    ): string {

        $now = now();


        /*
        |--------------------------------------------------------------------------
        | Draft / Cancelled
        |--------------------------------------------------------------------------
        */

        if ($election->status === 'draft') {
            return 'draft';
        }

        if ($election->status === 'cancelled') {
            return 'cancelled';
        }


        /*
        |--------------------------------------------------------------------------
        | Upcoming
        |--------------------------------------------------------------------------
        */

        if (
            $election->starts_at &&
            $now->lt($election->starts_at)
        ) {
            return 'upcoming';
        }


        /*
        |--------------------------------------------------------------------------
        | Closed
        |--------------------------------------------------------------------------
        */

        if (
            $election->ends_at &&
            $now->gt($election->ends_at)
        ) {
            return 'closed';
        }


        /*
        |--------------------------------------------------------------------------
        | Open
        |--------------------------------------------------------------------------
        */

        return 'open';
    }
}