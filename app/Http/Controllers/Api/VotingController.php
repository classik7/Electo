<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ballot;
use App\Models\BallotSelection;
use App\Models\Election;
use App\Models\ElectionVoter;
use App\Models\VotingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VotingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | START VOTING
    |--------------------------------------------------------------------------
    */

    public function start(
        Request $request,
        Election $election
    ): JsonResponse {

        $user = $request->user();

        $voter = $user->voter;


        /*
        |--------------------------------------------------------------------------
        | User must have voter profile
        |--------------------------------------------------------------------------
        */

        if (!$voter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'No voter profile is linked to this account.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | ElectionVoter
        |--------------------------------------------------------------------------
        */

        $electionVoter = ElectionVoter::where(
            'voter_id',
            $voter->id
        )
        ->where(
            'election_id',
            $election->id
        )
        ->first();


        if (!$electionVoter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not assigned to this election.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Eligibility
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not eligible to vote in this election.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Election Start
        |--------------------------------------------------------------------------
        */

        if (
            $election->starts_at &&
            now()->lt($election->starts_at)
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Voting has not opened yet.',
                'starts_at' =>
                    $election->starts_at,
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Election End
        |--------------------------------------------------------------------------
        */

        if (
            $election->ends_at &&
            now()->gt($election->ends_at)
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'This election has already closed.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Accreditation
        |--------------------------------------------------------------------------
        */

        if (
            $electionVoter->accreditation_status !==
            'accredited'
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Please complete accreditation before voting.',
                'accreditation_status' =>
                    $electionVoter->accreditation_status,
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Already Voted
        |--------------------------------------------------------------------------
        */

        if ($electionVoter->has_voted) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You have already voted in this election.',
            ], 409);

        }


        /*
        |--------------------------------------------------------------------------
        | Existing Active Session
        |--------------------------------------------------------------------------
        */

        $existingSession = VotingSession::where(
            'election_id',
            $election->id
        )
        ->where(
            'voter_id',
            $voter->id
        )
        ->whereIn(
            'status',
            [
                'pending',
                'authenticated',
                'ballot_open',
            ]
        )
        ->latest()
        ->first();


        if ($existingSession) {

            /*
            |--------------------------------------------------------------------------
            | Existing session still valid
            |--------------------------------------------------------------------------
            */

            if (
                $existingSession->expires_at &&
                $existingSession->expires_at->isFuture()
            ) {

                $ballot = Ballot::where(
                    'voting_session_id',
                    $existingSession->id
                )
                ->where(
                    'status',
                    'draft'
                )
                ->first();


                return response()->json([

                    'success' => true,

                    'message' =>
                        'Your active voting session was restored.',

                    'session_id' =>
                        $existingSession->id,

                    'ballot_id' =>
                        $ballot?->id,

                    'expires_at' =>
                        $existingSession->expires_at,

                    'status' =>
                        $existingSession->status,

                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | Expire old session
            |--------------------------------------------------------------------------
            */

            $existingSession->update([
                'status' => 'expired',
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Create Voting Session
        |--------------------------------------------------------------------------
        */

        $session = VotingSession::create([

            'election_id' =>
                $election->id,

            'voter_id' =>
                $voter->id,

            'voting_station_id' =>
                null,

            'voting_method' =>
                'personal_device',

            'status' =>
                'authenticated',

            'session_token' =>
                Str::uuid()->toString(),

            'authenticated_at' =>
                now(),

            'ballot_opened_at' =>
                now(),

            'expires_at' =>
                now()->addMinutes(30),

            'device_identifier' =>
                $request->header('X-Device-ID')
                ?? $request->userAgent(),

            'ip_address' =>
                $request->ip(),

            'user_agent' =>
                $request->userAgent(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Create Draft Ballot
        |--------------------------------------------------------------------------
        */

        $ballot = Ballot::create([

            'election_id' =>
                $election->id,

            'voting_session_id' =>
                $session->id,

            'status' =>
                'draft',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Session
        |--------------------------------------------------------------------------
        */

        $session->update([
            'status' => 'ballot_open',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return Session
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'message' =>
                'Voting session started successfully.',

            'session_id' =>
                $session->id,

            'ballot_id' =>
                $ballot->id,

            'expires_at' =>
                $session->expires_at,

            'status' =>
                $session->status,

        ], 201);
    }


    /*
    |--------------------------------------------------------------------------
    | REVIEW VOTE
    |--------------------------------------------------------------------------
    */

    public function review(
        Request $request,
        Election $election,
        VotingSession $session
    ): JsonResponse {

        $user = $request->user();

        $voter = $user->voter;


        /*
        |--------------------------------------------------------------------------
        | Verify voter
        |--------------------------------------------------------------------------
        */

        if (!$voter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'No voter profile is linked to this account.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Verify session ownership
        |--------------------------------------------------------------------------
        */

        if (
            $session->voter_id !== $voter->id ||
            $session->election_id !== $election->id
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'This voting session does not belong to you.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Session expiration
        |--------------------------------------------------------------------------
        */

        if (
            $session->expires_at &&
            $session->expires_at->isPast()
        ) {

            $session->update([
                'status' => 'expired',
            ]);

            return response()->json([
                'success' => false,
                'message' =>
                    'Your voting session has expired. Please start again.',
            ], 410);

        }


        /*
        |--------------------------------------------------------------------------
        | Get ElectionVoter
        |--------------------------------------------------------------------------
        */

        $electionVoter = ElectionVoter::where(
            'voter_id',
            $voter->id
        )
        ->where(
            'election_id',
            $election->id
        )
        ->first();


        if (!$electionVoter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not assigned to this election.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Security Checks
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not eligible to vote.',
            ], 403);

        }


        if (
            $electionVoter->accreditation_status !==
            'accredited'
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Please complete accreditation before voting.',
            ], 403);

        }


        if ($electionVoter->has_voted) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You have already voted.',
            ], 409);

        }


        /*
        |--------------------------------------------------------------------------
        | Get Positions
        |--------------------------------------------------------------------------
        */

        $positions = $election
            ->positions()
            ->with([
                'candidates' => function ($query) {

                    $query
                        ->where('status', 1)
                        ->orderBy('name');

                },
            ])
            ->orderBy('sort_order')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Validate Incoming Votes
        |--------------------------------------------------------------------------
        */

        $rules = [];

        foreach ($positions as $position) {

            $rules[
                'votes.' . $position->id
            ] = [
                'required',
                'integer',
            ];

        }


        $validated = $request->validate(
            $rules
        );


        $votes =
            $validated['votes'];


        /*
        |--------------------------------------------------------------------------
        | Validate Candidates
        |--------------------------------------------------------------------------
        */

        $selectedCandidates = [];


        foreach ($positions as $position) {

            $candidateId =
                $votes[$position->id]
                ?? null;


            $candidate =
                $position
                    ->candidates()
                    ->where(
                        'id',
                        $candidateId
                    )
                    ->first();


            if (!$candidate) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Invalid candidate selection detected.',
                    'position_id' =>
                        $position->id,
                ], 422);

            }


            $selectedCandidates[] = [

                'position_id' =>
                    $position->id,

                'position' =>
                    $position->name,

                'candidate_id' =>
                    $candidate->id,

                'candidate' =>
                    $candidate->name,

                'photo' =>
                    $candidate->photo,

            ];

        }


        /*
        |--------------------------------------------------------------------------
        | Return Review
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'message' =>
                'Vote selections are valid.',

            'session_id' =>
                $session->id,

            'ballot_id' =>
                Ballot::where(
                    'voting_session_id',
                    $session->id
                )
                ->where(
                    'status',
                    'draft'
                )
                ->value('id'),

            'expires_at' =>
                $session->expires_at,

            'selections' =>
                $selectedCandidates,

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT FINAL VOTE
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        Election $election,
        VotingSession $session
    ): JsonResponse {

        $user = $request->user();

        $voter = $user->voter;


        /*
        |--------------------------------------------------------------------------
        | Verify voter
        |--------------------------------------------------------------------------
        */

        if (!$voter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'No voter profile is linked to this account.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Verify session ownership
        |--------------------------------------------------------------------------
        */

        if (
            $session->voter_id !== $voter->id ||
            $session->election_id !== $election->id
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'This voting session does not belong to you.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Session expiration
        |--------------------------------------------------------------------------
        */

        if (
            $session->expires_at &&
            $session->expires_at->isPast()
        ) {

            $session->update([
                'status' => 'expired',
            ]);

            return response()->json([
                'success' => false,
                'message' =>
                    'Your voting session has expired. Please start again.',
            ], 410);

        }


        /*
        |--------------------------------------------------------------------------
        | ElectionVoter
        |--------------------------------------------------------------------------
        */

        $electionVoter = ElectionVoter::where(
            'voter_id',
            $voter->id
        )
        ->where(
            'election_id',
            $election->id
        )
        ->first();


        if (!$electionVoter) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not assigned to this election.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Final Security Checks
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You are not eligible to vote.',
            ], 403);

        }


        if (
            $electionVoter->accreditation_status !==
            'accredited'
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Please complete accreditation before voting.',
            ], 403);

        }


        if ($electionVoter->has_voted) {

            return response()->json([
                'success' => false,
                'message' =>
                    'You have already voted in this election.',
            ], 409);

        }


        /*
        |--------------------------------------------------------------------------
        | Election Timing
        |--------------------------------------------------------------------------
        */

        if (
            $election->starts_at &&
            now()->lt($election->starts_at)
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'Voting has not opened yet.',
            ], 403);

        }


        if (
            $election->ends_at &&
            now()->gt($election->ends_at)
        ) {

            return response()->json([
                'success' => false,
                'message' =>
                    'This election has already closed.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Get Draft Ballot
        |--------------------------------------------------------------------------
        */

        $ballot = Ballot::where(
            'voting_session_id',
            $session->id
        )
        ->where(
            'status',
            'draft'
        )
        ->first();


        if (!$ballot) {

            return response()->json([
                'success' => false,
                'message' =>
                    'No active ballot was found for this session.',
            ], 404);

        }


        /*
        |--------------------------------------------------------------------------
        | Validate Votes
        |--------------------------------------------------------------------------
        */

        $positions = $election
            ->positions()
            ->with([
                'candidates' => function ($query) {

                    $query->where(
                        'status',
                        1
                    );

                },
            ])
            ->orderBy('sort_order')
            ->get();


        $rules = [];

        foreach ($positions as $position) {

            $rules[
                'votes.' . $position->id
            ] = [
                'required',
                'integer',
            ];

        }


        $validated = $request->validate(
            $rules
        );


        $votes =
            $validated['votes'];


        /*
        |--------------------------------------------------------------------------
        | Final Candidate Validation
        |--------------------------------------------------------------------------
        */

        foreach ($positions as $position) {

            $candidateId =
                $votes[$position->id]
                ?? null;


            $exists =
                $position
                    ->candidates()
                    ->where(
                        'id',
                        $candidateId
                    )
                    ->exists();


            if (!$exists) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'Invalid candidate selection detected.',
                    'position_id' =>
                        $position->id,
                ], 422);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Database Transaction
        |--------------------------------------------------------------------------
        */

        try {

            $result = DB::transaction(
                function () use (
                    $election,
                    $session,
                    $ballot,
                    $electionVoter,
                    $votes
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock ElectionVoter
                    |--------------------------------------------------------------------------
                    */

                    $lockedElectionVoter =
                        ElectionVoter::where(
                            'id',
                            $electionVoter->id
                        )
                        ->lockForUpdate()
                        ->firstOrFail();


                    /*
                    |--------------------------------------------------------------------------
                    | Prevent Double Voting
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $lockedElectionVoter->has_voted
                    ) {

                        throw new \RuntimeException(
                            'This voter has already voted.'
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Lock Ballot
                    |--------------------------------------------------------------------------
                    */

                    $lockedBallot =
                        Ballot::where(
                            'id',
                            $ballot->id
                        )
                        ->where(
                            'status',
                            'draft'
                        )
                        ->lockForUpdate()
                        ->firstOrFail();


                    /*
                    |--------------------------------------------------------------------------
                    | Clear Existing Selections
                    |--------------------------------------------------------------------------
                    */

                    BallotSelection::where(
                        'ballot_id',
                        $lockedBallot->id
                    )->delete();


                    /*
                    |--------------------------------------------------------------------------
                    | Create Selections
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $votes as
                        $positionId => $candidateId
                    ) {

                        $candidate =
                            $election
                                ->positions()
                                ->where(
                                    'election_positions.id',
                                    $positionId
                                )
                                ->firstOrFail()
                                ->candidates()
                                ->where(
                                    'candidates.id',
                                    $candidateId
                                )
                                ->firstOrFail();


                        BallotSelection::create([

                            'ballot_id' =>
                                $lockedBallot->id,

                            'election_position_id' =>
                                $positionId,

                            'candidate_id' =>
                                $candidate->id,

                        ]);

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Submit Ballot
                    |--------------------------------------------------------------------------
                    */

                    $lockedBallot->update([

                        'status' =>
                            'submitted',

                        'submitted_at' =>
                            now(),

                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Complete Session
                    |--------------------------------------------------------------------------
                    */

                    $session->update([

                        'status' =>
                            'submitted',

                        'submitted_at' =>
                            now(),

                        'completed_at' =>
                            now(),

                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Mark ElectionVoter As Voted
                    |--------------------------------------------------------------------------
                    */

                    $lockedElectionVoter->update([

                        'has_voted' =>
                            true,

                        'voted_at' =>
                            now(),

                    ]);


                    return [

                        'ballot' =>
                            $lockedBallot,

                        'session' =>
                            $session,

                    ];

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' => true,

                'message' =>
                    'Your vote has been submitted successfully.',

                'election_id' =>
                    $election->id,

                'session_id' =>
                    $result['session']->id,

                'ballot_id' =>
                    $result['ballot']->id,

                'submitted_at' =>
                    $result['ballot']->submitted_at,

            ], 201);


        } catch (\RuntimeException $exception) {

            return response()->json([

                'success' => false,

                'message' =>
                    $exception->getMessage(),

            ], 409);


        } catch (\Throwable $exception) {

            report($exception);

            return response()->json([

                'success' => false,

                'message' =>
                    'Unable to submit your vote. Please try again.',

            ], 500);

        }
    }
}