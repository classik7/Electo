<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\BallotSelection;
use App\Models\Election;
use App\Models\ElectionVoter;
use App\Models\VotingSession;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VotingController extends Controller
{
    /**
     * Show elections available to the current voter.
     *
     * The election-selection page is based on the voter's
     * eligibility, not accreditation status.
     *
     * Closed elections are excluded from My Voting.
     * Elections that are upcoming or currently open remain visible.
     */
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in before voting.'
                );
        }

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Get linked voter
        |--------------------------------------------------------------------------
        */

        $voter = $user->voter;

        if (!$voter) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Your account is not linked to a voter profile.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Get elections assigned to THIS voter
        |--------------------------------------------------------------------------
        |
        | Important:
        |
        | We only use eligibility here to decide whether an election
        | belongs on the My Voting page.
        |
        | We deliberately DO NOT require:
        |
        | - accreditation_status
        | - has_voted = false
        |
        | Accreditation and voting state are handled by the election card
        | and the secure voting-start flow.
        |
        */

        $elections = Election::query()

            ->whereHas(
                'electionVoters',
                function ($query) use ($voter) {

                    $query
                        ->where(
                            'voter_id',
                            $voter->id
                        )
                        ->where(
                            'is_eligible',
                            true
                        );

                }
            )


            /*
            |--------------------------------------------------------------------------
            | Exclude CLOSED elections
            |--------------------------------------------------------------------------
            |
            | Upcoming elections:
            |     starts_at > now()
            |
            | Ongoing elections:
            |     starts_at <= now() and ends_at >= now()
            |
            | Elections with no end date remain visible.
            |
            */

            ->where(function ($query) {

                $query
                    ->whereNull('ends_at')
                    ->orWhere(
                        'ends_at',
                        '>=',
                        now()
                    );

            })


            /*
            |--------------------------------------------------------------------------
            | Load THIS voter's election record only
            |--------------------------------------------------------------------------
            */

            ->with([
                'organization',
                'electionType',

                'electionVoters' => function ($query) use ($voter) {

                    $query->where(
                        'voter_id',
                        $voter->id
                    );

                },

            ])


            /*
            |--------------------------------------------------------------------------
            | Upcoming elections first
            |--------------------------------------------------------------------------
            */

            ->orderByRaw(
                'CASE
                    WHEN starts_at IS NOT NULL
                         AND starts_at > ?
                    THEN 0
                    ELSE 1
                 END',
                [now()]
            )

            ->orderBy(
                'starts_at',
                'asc'
            )

            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return election-selection page
        |--------------------------------------------------------------------------
        */

        return view(
            'electo.voting.index',
            [
                'voter' => $voter,
                'elections' => $elections,
            ]
        );
    }


    /**
     * Start the voting session.
     */
    public function start(
        Request $request,
        Voter $voter,
        Election $election
    ) {
        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in before voting.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Verify User → Voter
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        $linkedVoter = $user->voter;


        if (!$linkedVoter) {

            return back()->with(
                'error',
                'Your account is not linked to a voter profile.'
            );
        }


        if ($linkedVoter->id !== $voter->id) {

            abort(403);
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
        ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Eligibility
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return back()->with(
                'error',
                'You are not eligible to vote in this election.'
            );
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

            return back()->with(
                'info',
                'Voting has not opened for this election yet. Voting starts on ' .
                $election->starts_at->format('d M Y \a\t h:i A') . '.'
            );
        }


        if (
            $election->ends_at &&
            now()->gt($election->ends_at)
        ) {

            return back()->with(
                'error',
                'This election has already closed.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Accreditation
        |--------------------------------------------------------------------------
        */

        if (
            $electionVoter->accreditation_status !== 'accredited'
        ) {

            return redirect()
                ->route(
                    'accreditation.show',
                    [
                        'voter' => $voter,
                        'election' => $election,
                    ]
                )
                ->with(
                    'info',
                    'Please complete accreditation before voting.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Already Voted
        |--------------------------------------------------------------------------
        */

        if ($electionVoter->has_voted) {

            return back()->with(
                'error',
                'You have already voted in this election.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Existing Active Session
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
            | Check Expiration
            |--------------------------------------------------------------------------
            */

            if (
                $existingSession->expires_at &&
                $existingSession->expires_at->isFuture()
            ) {

                return redirect()
                    ->route(
                        'voting.ballot',
                        [
                            'voter' =>
                                $voter,

                            'election' =>
                                $election,

                            'session' =>
                                $existingSession->id,
                        ]
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Expire Old Session
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
                $request->userAgent(),

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
        | Redirect to Ballot
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'voting.ballot',
                [
                    'voter' =>
                        $voter,

                    'election' =>
                        $election,

                    'session' =>
                        $session->id,
                ]
            );
    }


    /**
     * Show the ballot.
     */
    public function ballot(
        Request $request,
        Voter $voter,
        Election $election,
        VotingSession $session
    ) {

        /*
        |--------------------------------------------------------------------------
        | Verify Session
        |--------------------------------------------------------------------------
        */

        $this->verifySession(
            $request,
            $voter,
            $election,
            $session
        );


        /*
        |--------------------------------------------------------------------------
        | Check Expiration
        |--------------------------------------------------------------------------
        */

        if (
            $session->expires_at &&
            $session->expires_at->isPast()
        ) {

            $session->update([
                'status' => 'expired',
            ]);

            return redirect()
                ->route(
                    'accreditation.show',
                    [
                        'voter' =>
                            $voter,

                        'election' =>
                            $election,
                    ]
                )
                ->with(
                    'error',
                    'Your voting session has expired. Please start again.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Get Ballot
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
        ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Get Positions + Candidates
        |--------------------------------------------------------------------------
        */

        $positions = $election
            ->positions()
            ->with([
                'candidates' => function ($query) {

                    $query
                        ->where(
                            'status',
                            1
                        )
                        ->orderBy(
                            'name'
                        );

                },
            ])
            ->orderBy(
                'sort_order'
            )
            ->get();


        return view(
            'electo.voting.ballot',
            compact(
                'voter',
                'election',
                'session',
                'ballot',
                'positions'
            )
        );
    }


    /**
     * Review selected votes.
     */
    public function review(
        Request $request,
        Voter $voter,
        Election $election,
        VotingSession $session
    ) {

        /*
        |--------------------------------------------------------------------------
        | Verify Session
        |--------------------------------------------------------------------------
        */

        $this->verifySession(
            $request,
            $voter,
            $election,
            $session
        );


        /*
        |--------------------------------------------------------------------------
        | Check Expiration
        |--------------------------------------------------------------------------
        */

        if (
            $session->expires_at &&
            $session->expires_at->isPast()
        ) {

            $session->update([
                'status' => 'expired',
            ]);

            return redirect()
                ->route(
                    'accreditation.show',
                    [
                        'voter' =>
                            $voter,

                        'election' =>
                            $election,
                    ]
                )
                ->with(
                    'error',
                    'Your voting session has expired.'
                );
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

                    $query->where(
                        'status',
                        1
                    );

                },
            ])
            ->orderBy(
                'sort_order'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Validate Selections
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


        /*
        |--------------------------------------------------------------------------
        | Verify Every Candidate
        |--------------------------------------------------------------------------
        */

        foreach ($positions as $position) {

            $candidateId =
                $validated['votes'][$position->id]
                ?? null;


            if (!$candidateId) {
                continue;
            }


            $candidateExists =
                $position
                    ->candidates()
                    ->where(
                        'id',
                        $candidateId
                    )
                    ->exists();


            if (!$candidateExists) {

                return back()
                    ->withErrors([
                        'votes' =>
                            'Invalid candidate selection detected.',
                    ])
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Store Selections Temporarily in Session
        |--------------------------------------------------------------------------
        */

        $request->session()->put(
            'voting_selections.' . $session->id,
            $validated['votes']
        );


        /*
        |--------------------------------------------------------------------------
        | Prepare Review Data
        |--------------------------------------------------------------------------
        */

        $selectedCandidates = [];

        foreach ($positions as $position) {

            $candidateId =
                $validated['votes'][$position->id]
                ?? null;


            if (!$candidateId) {
                continue;
            }


            $candidate =
                $position
                    ->candidates()
                    ->where(
                        'id',
                        $candidateId
                    )
                    ->first();


            if ($candidate) {

                $selectedCandidates[] = [

                    'position' =>
                        $position,

                    'candidate' =>
                        $candidate,

                ];
            }
        }


        return view(
            'electo.voting.review',
            compact(
                'voter',
                'election',
                'session',
                'selectedCandidates'
            )
        );
    }


    /**
     * Submit the final ballot.
     */
    public function submit(
        Request $request,
        Voter $voter,
        Election $election,
        VotingSession $session
    ) {

        /*
        |--------------------------------------------------------------------------
        | Verify Session
        |--------------------------------------------------------------------------
        */

        $this->verifySession(
            $request,
            $voter,
            $election,
            $session
        );


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
        ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Final Security Checks
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            abort(403);
        }


        if ($electionVoter->has_voted) {

            return redirect()
                ->route(
                    'accreditation.show',
                    [
                        'voter' =>
                            $voter,

                        'election' =>
                            $election,
                    ]
                )
                ->with(
                    'error',
                    'This voter has already voted.'
                );
        }


        if (
            $electionVoter->accreditation_status !==
            'accredited'
        ) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Stored Selections
        |--------------------------------------------------------------------------
        */

        $selections =
            $request->session()->get(
                'voting_selections.' . $session->id
            );


        if (
            !is_array($selections) ||
            empty($selections)
        ) {

            return redirect()
                ->route(
                    'voting.ballot',
                    [
                        'voter' =>
                            $voter,

                        'election' =>
                            $election,

                        'session' =>
                            $session->id,
                    ]
                )
                ->with(
                    'error',
                    'No vote selections were found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Database Transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $session,
                $election,
                $electionVoter,
                $selections
            ) {

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
                ->lockForUpdate()
                ->firstOrFail();


                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Submission
                |--------------------------------------------------------------------------
                */

                if (
                    $electionVoter->has_voted
                ) {

                    throw new \RuntimeException(
                        'This voter has already voted.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Clear Existing Draft Selections
                |--------------------------------------------------------------------------
                */

                BallotSelection::where(
                    'ballot_id',
                    $ballot->id
                )->delete();


                /*
                |--------------------------------------------------------------------------
                | Validate & Save Selections
                |--------------------------------------------------------------------------
                */

                foreach (
                    $selections as $positionId => $candidateId
                ) {

                    $candidate = $election
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
                            $ballot->id,

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

                $ballot->update([

                    'status' =>
                        'submitted',

                    'submitted_at' =>
                        now(),

                ]);


                /*
                |--------------------------------------------------------------------------
                | Update Voting Session
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
                | Mark Voter As Having Voted
                |--------------------------------------------------------------------------
                */

                $electionVoter->update([

                    'has_voted' =>
                        true,

                    'voted_at' =>
                        now(),

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Remove Temporary Selections
        |--------------------------------------------------------------------------
        */

        $request->session()->forget(
            'voting_selections.' . $session->id
        );


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'voting.completed',
                [
                    'voter' =>
                        $voter,

                    'election' =>
                        $election,

                    'session' =>
                        $session->id,
                ]
            );
    }


    /**
     * Voting completed page.
     */
    public function completed(
        Request $request,
        Voter $voter,
        Election $election,
        VotingSession $session
    ) {

        $this->verifySession(
            $request,
            $voter,
            $election,
            $session
        );


        return view(
            'electo.voting.completed',
            compact(
                'voter',
                'election',
                'session'
            )
        );
    }


    /**
     * Verify that the session belongs to the correct
     * voter and election.
     */
    private function verifySession(
        Request $request,
        Voter $voter,
        Election $election,
        VotingSession $session
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | User → Voter
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        $linkedVoter = $user->voter;


        if (!$linkedVoter) {

            abort(403);
        }


        if ($linkedVoter->id !== $voter->id) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Session Ownership
        |--------------------------------------------------------------------------
        */

        if (
            $session->voter_id !== $voter->id ||
            $session->election_id !== $election->id
        ) {

            abort(403);
        }
    }
}