<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionVoter;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccreditationController extends Controller
{
    /**
     * Show the accreditation page for a voter in an election.
     */
    public function show(
        Voter $voter,
        Election $election
    ) {
        $electionVoter = $this->getElectionVoter(
            $voter,
            $election
        );

        /*
        |--------------------------------------------------------------------------
        | Check Eligibility
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return redirect()
                ->route('voters.show', $voter)
                ->with(
                    'error',
                    'This voter is not eligible to vote in this election.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Already Voted
        |--------------------------------------------------------------------------
        */

        if ($electionVoter->has_voted) {

            return redirect()
                ->route('voters.show', $voter)
                ->with(
                    'error',
                    'This voter has already voted in this election.'
                );
        }


        return view(
            'electo.accreditation.show',
            compact(
                'voter',
                'election',
                'electionVoter'
            )
        );
    }


    /**
     * Accredit a voter using a personal device.
     *
     * Passkey authentication is performed in the browser
     * using Laravel's official Passkeys confirmation flow
     * before this request is submitted.
     */
    public function personalDevice(
        Request $request,
        Voter $voter,
        Election $election
    ) {
        /*
        |--------------------------------------------------------------------------
        | Require Authentication
        |--------------------------------------------------------------------------
        */

        if (!Auth::check()) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in before using personal-device accreditation.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Verify User → Voter Relationship
        |--------------------------------------------------------------------------
        |
        | A user must only be able to accredit the voter account
        | that belongs to them.
        |
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

            return back()->with(
                'error',
                'You are not authorized to accredit this voter.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Get Election Voter
        |--------------------------------------------------------------------------
        */

        $electionVoter = $this->getElectionVoter(
            $voter,
            $election
        );


        /*
        |--------------------------------------------------------------------------
        | Check Eligibility
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return back()->with(
                'error',
                'This voter is not eligible for this election.'
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
                'This voter has already voted in this election.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Accreditation Status
        |--------------------------------------------------------------------------
        */

        if (
            $electionVoter->accreditation_status === 'accredited'
        ) {

            return back()->with(
                'error',
                'This voter has already been accredited for this election.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Accreditation Reference
        |--------------------------------------------------------------------------
        */

        $reference = $this->generateReference();


        /*
        |--------------------------------------------------------------------------
        | Accredit Voter
        |--------------------------------------------------------------------------
        */

        $electionVoter->update([

            'accreditation_status' =>
                'accredited',

            'accredited_at' =>
                now(),

            'accredited_by' =>
                $user->id,

            'accreditation_method' =>
                'personal_device',

            'accreditation_reference' =>
                $reference,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'accreditation.show',
                [
                    'voter' => $voter,
                    'election' => $election,
                ]
            )
            ->with(
                'success',
                'Voter successfully authenticated and accredited using a personal device.'
            );
    }


    /**
     * Accredit a voter using a public device.
     */
    public function publicDevice(
        Request $request,
        Voter $voter,
        Election $election
    ) {
        $electionVoter = $this->getElectionVoter(
            $voter,
            $election
        );


        /*
        |--------------------------------------------------------------------------
        | Check Eligibility
        |--------------------------------------------------------------------------
        */

        if (!$electionVoter->is_eligible) {

            return back()->with(
                'error',
                'This voter is not eligible for this election.'
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
                'This voter has already voted in this election.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Already Accredited
        |--------------------------------------------------------------------------
        */

        if (
            $electionVoter->accreditation_status === 'accredited'
        ) {

            return back()->with(
                'error',
                'This voter has already been accredited for this election.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Public Device Accreditation
        |--------------------------------------------------------------------------
        */

        $reference = $this->generateReference();


        $electionVoter->update([

            'accreditation_status' =>
                'accredited',

            'accredited_at' =>
                now(),

            'accredited_by' =>
                auth()->id(),

            'accreditation_method' =>
                'public_device',

            'accreditation_reference' =>
                $reference,

        ]);


        return redirect()
            ->route(
                'accreditation.show',
                [
                    'voter' => $voter,
                    'election' => $election,
                ]
            )
            ->with(
                'success',
                'Voter successfully accredited using a public device.'
            );
    }


    /**
     * Get the voter-election participation record.
     */
    private function getElectionVoter(
        Voter $voter,
        Election $election
    ): ElectionVoter {

        return ElectionVoter::where(
            'voter_id',
            $voter->id
        )
        ->where(
            'election_id',
            $election->id
        )
        ->firstOrFail();
    }


    /**
     * Generate a unique accreditation reference.
     */
    private function generateReference(): string
    {
        do {

            $reference =
                'ACC-' .
                strtoupper(
                    Str::random(10)
                );

        } while (
            ElectionVoter::where(
                'accreditation_reference',
                $reference
            )->exists()
        );


        return $reference;
    }
}