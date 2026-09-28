<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    /**
     * Issue a certificate to an election winner.
     */
    public function issue(
        Request $request,
        Election $election,
        ElectionPosition $position,
        Candidate $candidate
    ) {
		/*
|--------------------------------------------------------------------------
| Certificate Issuance Authorization
|--------------------------------------------------------------------------
*/

if (!auth()->user()->hasAnyRole([
    'admin',
    'election_official',
])) {
    abort(403, 'You are not authorized to issue election certificates.');
}
        /*
        |--------------------------------------------------------------------------
        | Verify Position Belongs To Election
        |--------------------------------------------------------------------------
        */

        if ($position->election_id !== $election->id) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Candidate Belongs To Election
        |--------------------------------------------------------------------------
        */

        if ($candidate->election_id !== $election->id) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Candidate Belongs To Position
        |--------------------------------------------------------------------------
        */

        if ($candidate->election_position_id !== $position->id) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Candidate Is Actually The Winner
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Candidate Must Have At Least One Vote
        |--------------------------------------------------------------------------
        */

        if ($votes < 1) {

            return back()->with(
                'error',
                'A certificate cannot be issued because this candidate did not receive any votes.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Determine Highest Vote Count
        |--------------------------------------------------------------------------
        */

        $highestVotes = DB::table('ballot_selections')
            ->join(
                'ballots',
                'ballot_selections.ballot_id',
                '=',
                'ballots.id'
            )
            ->join(
                'candidates',
                'ballot_selections.candidate_id',
                '=',
                'candidates.id'
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
                'candidates.election_position_id',
                $position->id
            )
            ->select(
                'ballot_selections.candidate_id',
                DB::raw('COUNT(*) as vote_count')
            )
            ->groupBy(
                'ballot_selections.candidate_id'
            )
            ->orderByDesc(
                'vote_count'
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | No Results
        |--------------------------------------------------------------------------
        */

        if (!$highestVotes) {

            return back()->with(
                'error',
                'No submitted votes were found for this position.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Candidate Is Not The Winner
        |--------------------------------------------------------------------------
        */

        if (
            $highestVotes->candidate_id !== $candidate->id ||
            $votes < $highestVotes->vote_count
        ) {

            return back()->with(
                'error',
                'A certificate can only be issued to the winner of this position.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Existing Certificate
        |--------------------------------------------------------------------------
        */

        $existingCertificate = Certificate::where(
            'election_id',
            $election->id
        )
        ->where(
            'candidate_id',
            $candidate->id
        )
        ->where(
            'election_position_id',
            $position->id
        )
        ->first();


        if ($existingCertificate) {

            return redirect()
                ->route(
                    'certificates.show',
                    $existingCertificate
                )
                ->with(
                    'success',
                    'A certificate has already been issued to this winner.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Certificate Number
        |--------------------------------------------------------------------------
        */

        $certificateNumber =
            $this->generateCertificateNumber(
                $election
            );


        /*
        |--------------------------------------------------------------------------
        | Generate Verification Code
        |--------------------------------------------------------------------------
        */

        $verificationCode =
            $this->generateVerificationCode();


        /*
        |--------------------------------------------------------------------------
        | Create Certificate
        |--------------------------------------------------------------------------
        */

        $certificate = Certificate::create([

            'election_id' =>
                $election->id,

            'candidate_id' =>
                $candidate->id,

            'election_position_id' =>
                $position->id,

            'certificate_number' =>
                $certificateNumber,

            'verification_code' =>
                $verificationCode,

            'issued_at' =>
                now(),

            'issued_by' =>
                auth()->id(),

            'status' =>
                'issued',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect To Certificate
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'certificates.show',
                $certificate
            )
            ->with(
                'success',
                'Winner certificate issued successfully.'
            );
    }


    /**
     * Display a certificate.
     */
    public function show(
        Certificate $certificate
    ) {
		if (!auth()->user()->hasAnyRole([
    'admin',
    'election_official',
])) {
    abort(403, 'You are not authorized to view official certificates.');
}
        $certificate->load([
            'election',
            'candidate',
            'position',
            'issuer',
        ]);


        return view(
            'electo.certificates.show',
            compact(
                'certificate'
            )
        );
    }


    /**
     * Generate a unique certificate number.
     */
    private function generateCertificateNumber(
        Election $election
    ): string {

        do {

            $number =
                'ELC-' .
                now()->format('Y') .
                '-' .
                str_pad(
                    (string) $election->id,
                    4,
                    '0',
                    STR_PAD_LEFT
                ) .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Certificate::where(
                'certificate_number',
                $number
            )->exists()
        );


        return $number;
    }


    /**
     * Generate a unique verification code.
     */
    private function generateVerificationCode(): string
    {
        do {

            $code =
                'ELCT-' .
                strtoupper(
                    Str::random(10)
                );

        } while (
            Certificate::where(
                'verification_code',
                $code
            )->exists()
        );


        return $code;
    }
	
	
	
	
	public function verify(string $verification_code)
{
    $certificate = \App\Models\Certificate::with([
        'election',
        'candidate',
        'position',
    ])
    ->where(
        'verification_code',
        $verification_code
    )
    ->first();

    if (!$certificate) {
        abort(404, 'Certificate could not be verified.');
    }

    return view(
        'electo.certificates.verify',
        compact('certificate')
    );
}


}