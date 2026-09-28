<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Election;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    /**
     * Display a listing of voters.
     */
    public function index(Request $request)
    {
        $query = Voter::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->input('search');

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('voter_id', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->input('status')
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Get Voters
        |--------------------------------------------------------------------------
        */

        $voters = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalVoters = Voter::count();

        $activeVoters = Voter::where(
            'status',
            'active'
        )->count();

        $inactiveVoters = Voter::where(
            'status',
            'inactive'
        )->count();

        $suspendedVoters = Voter::where(
            'status',
            'suspended'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'electo.voters.index',
            compact(
                'voters',
                'totalVoters',
                'activeVoters',
                'inactiveVoters',
                'suspendedVoters'
            )
        );
    }


    /**
     * Show the form for creating a new voter.
     */
    public function create()
    {
        return view('electo.voters.create');
    }


    /**
     * Store a newly created voter.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'voter_id' => [
                'required',
                'string',
                'max:100',
                'unique:voters,voter_id',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'photo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:active,inactive,suspended',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Photo Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $validated['photo'] =
                $request->file('photo')
                    ->store('voters', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Create Voter
        |--------------------------------------------------------------------------
        */

        Voter::create($validated);


        return redirect()
            ->route('voters.index')
            ->with(
                'success',
                'Voter created successfully.'
            );
    }


    /**
     * Display the specified voter.
     */
    public function show(Voter $voter)
    {
        $voter->load([
            'elections',
            'electionVoters.election',
        ]);

        return view(
            'electo.voters.show',
            compact('voter')
        );
    }


    /**
     * Show the form for editing the specified voter.
     */
    public function edit(Voter $voter)
    {
        return view(
            'electo.voters.edit',
            compact('voter')
        );
    }


    /**
     * Update the specified voter.
     */
    public function update(
        Request $request,
        Voter $voter
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'voter_id' => [
                'required',
                'string',
                'max:100',
                'unique:voters,voter_id,' . $voter->id,
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'photo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'status' => [
                'required',
                'in:active,inactive,suspended',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Photo Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $validated['photo'] =
                $request->file('photo')
                    ->store('voters', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Update Voter
        |--------------------------------------------------------------------------
        */

        $voter->update($validated);


        return redirect()
            ->route(
                'voters.show',
                $voter
            )
            ->with(
                'success',
                'Voter updated successfully.'
            );
    }

	/**
 * Show the form for assigning a voter to an election.
 */
public function createElectionAssignment(Voter $voter)
{
    $elections = Election::query()
        ->whereNotIn(
            'id',
            $voter->elections()->pluck('elections.id')
        )
        ->latest()
        ->get();

    return view(
        'electo.voters.elections.create',
        compact('voter', 'elections')
    );
}


/**
 * Assign a voter to an election.
 */
public function assignToElection(
    Request $request,
    Voter $voter
) {
    $validated = $request->validate([

        'election_id' => [
            'required',
            'exists:elections,id',
        ],

        'is_eligible' => [
            'required',
            'boolean',
        ],

    ]);


    /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Assignment
    |--------------------------------------------------------------------------
    */

    $alreadyAssigned = $voter->elections()
        ->where(
            'elections.id',
            $validated['election_id']
        )
        ->exists();


    if ($alreadyAssigned) {

        return redirect()
            ->route('voters.show', $voter)
            ->with(
                'error',
                'This voter is already assigned to that election.'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | Assign Voter
    |--------------------------------------------------------------------------
    */

    $voter->elections()->attach(
        $validated['election_id'],
        [

            'is_eligible' =>
                $validated['is_eligible'],

            'accreditation_status' =>
                'pending',

            'accredited_at' =>
                null,

            'accreditation_method' =>
                null,

            'has_voted' =>
                false,

            'voted_at' =>
                null,

        ]
    );


    return redirect()
        ->route('voters.show', $voter)
        ->with(
            'success',
            'Voter successfully assigned to the election.'
        );
}

    /**
     * Remove the specified voter.
     */
    public function destroy(Voter $voter)
{
    // Prevent deletion if this voter has already voted
    $hasVoted = $voter->electionVoters()
        ->where('has_voted', true)
        ->exists();

    if ($hasVoted) {
        return redirect()
            ->route('voters.show', $voter)
            ->with('error', 'This voter cannot be deleted because they have already voted in an election.');
    }

    // Soft delete the voter
    $voter->delete();

    return redirect()
        ->route('voters.index')
        ->with('success', 'Voter deleted successfully.');
}

/**
 * Remove a voter from an election.
 */
public function removeFromElection(
    Voter $voter,
    Election $election
) {
    $electionVoter = $voter->electionVoters()
        ->where('election_id', $election->id)
        ->first();

    if (!$electionVoter) {

        return redirect()
            ->route('voters.show', $voter)
            ->with(
                'error',
                'This voter is not assigned to that election.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Protect Election Participation After Voting
    |--------------------------------------------------------------------------
    */

    if ($electionVoter->has_voted) {

        return redirect()
            ->route('voters.show', $voter)
            ->with(
                'error',
                'This voter cannot be removed because they have already voted in this election.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Assignment
    |--------------------------------------------------------------------------
    */

    $electionVoter->delete();


    return redirect()
        ->route('voters.show', $voter)
        ->with(
            'success',
            'Voter removed from the election successfully.'
        );
}
}