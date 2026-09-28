<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectionPosition;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    /**
     * =========================================================
     * CANDIDATES FOR ONE ELECTION
     * =========================================================
     */
    public function index(Election $election)
    {
        /*
        |--------------------------------------------------------------------------
        | Verify that the authenticated user owns the organization
        |--------------------------------------------------------------------------
        */

        Organization::where('id', $election->organization_id)
            ->where('owner_id', auth()->id())
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Load election data
        |--------------------------------------------------------------------------
        */

        $election->load([
            'organization',
            'electionType',
            'positions.candidates',
        ]);

        return view(
            'electo.candidates.index',
            compact('election')
        );
    }


    /**
     * =========================================================
     * CANDIDATE LANDING PAGE
     *
     * Shows the user's elections first.
     * User then chooses which election to manage.
     * =========================================================
     */
    public function all()
    {
        /*
        |--------------------------------------------------------------------------
        | Get organizations owned by authenticated user
        |--------------------------------------------------------------------------
        */

        $organizationIds = Organization::where(
            'owner_id',
            auth()->id()
        )->pluck('id');


        /*
        |--------------------------------------------------------------------------
        | Get elections belonging to those organizations
        |--------------------------------------------------------------------------
        */

        $elections = Election::query()
            ->whereIn('organization_id', $organizationIds)
            ->with([
                'organization',
                'electionType',
            ])
            ->withCount([
                'candidates',
                'positions',
            ])
            ->latest()
            ->get();


        return view(
            'electo.candidates.all',
            compact('elections')
        );
    }


    /**
     * =========================================================
     * CREATE CANDIDATE
     * =========================================================
     */
    public function create(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get election
        |--------------------------------------------------------------------------
        */

        $election = Election::with([
            'organization',
            'electionType',
            'positions',
        ])->findOrFail($request->election);


        /*
        |--------------------------------------------------------------------------
        | Verify ownership
        |--------------------------------------------------------------------------
        */

        Organization::where('id', $election->organization_id)
            ->where('owner_id', auth()->id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Get position belonging to this election
        |--------------------------------------------------------------------------
        */

        $position = $election->positions()
            ->findOrFail($request->position);


        return view(
            'electo.candidates.create',
            compact(
                'election',
                'position'
            )
        );
    }


    /**
     * =========================================================
     * STORE CANDIDATE
     * =========================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'election_id' => [
                'required',
                'integer',
                'exists:elections,id',
            ],

            'election_position_id' => [
                'required',
                'integer',
                'exists:election_positions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'bio' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Get election
        |--------------------------------------------------------------------------
        */

        $election = Election::findOrFail(
            $validated['election_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Verify ownership
        |--------------------------------------------------------------------------
        */

        Organization::where('id', $election->organization_id)
            ->where('owner_id', auth()->id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Verify position belongs to election
        |--------------------------------------------------------------------------
        */

        $position = $election->positions()
            ->findOrFail(
                $validated['election_position_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Generate unique slug within this election
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug(
            $validated['name']
        );

        $slug = $baseSlug;

        $counter = 1;

        while (
            Candidate::where('election_id', $election->id)
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload photo
        |--------------------------------------------------------------------------
        */

        $photoPath = null;

        if ($request->hasFile('photo')) {

            $photoPath = $request
                ->file('photo')
                ->store(
                    'candidates',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Create candidate
        |--------------------------------------------------------------------------
        */

        Candidate::create([

            'election_id' => $election->id,

            'election_position_id' => $position->id,

            'name' => $validated['name'],

            'slug' => $slug,

            'photo' => $photoPath,

            'bio' => $validated['bio'] ?? null,

            'status' => true,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Return to the correct election
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'elections.candidates',
                $election
            )
            ->with(
                'success',
                'Candidate added successfully.'
            );
    }


    /**
     * =========================================================
     * SHOW CANDIDATE
     * =========================================================
     */
    public function show(Candidate $candidate)
    {
        $candidate->load([
            'election',
            'position',
        ]);


        Organization::where(
            'id',
            $candidate->election->organization_id
        )
            ->where(
                'owner_id',
                auth()->id()
            )
            ->firstOrFail();


        return view(
            'electo.candidates.show',
            compact('candidate')
        );
    }


    /**
     * =========================================================
     * EDIT CANDIDATE
     * =========================================================
     */
    public function edit(Candidate $candidate)
    {
        $candidate->load([
            'election',
            'position',
        ]);


        Organization::where(
            'id',
            $candidate->election->organization_id
        )
            ->where(
                'owner_id',
                auth()->id()
            )
            ->firstOrFail();


        $positions = $candidate->election
            ->positions()
            ->orderBy('sort_order')
            ->get();


        return view(
            'electo.candidates.edit',
            compact(
                'candidate',
                'positions'
            )
        );
    }


    /**
     * =========================================================
     * UPDATE CANDIDATE
     * =========================================================
     */
    public function update(
        Request $request,
        Candidate $candidate
    ) {

        $candidate->load('election');


        Organization::where(
            'id',
            $candidate->election->organization_id
        )
            ->where(
                'owner_id',
                auth()->id()
            )
            ->firstOrFail();


        $validated = $request->validate([

            'election_position_id' => [
                'required',
                'integer',
                'exists:election_positions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'bio' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verify position belongs to same election
        |--------------------------------------------------------------------------
        */

        $position = $candidate->election
            ->positions()
            ->findOrFail(
                $validated['election_position_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Generate unique slug
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug(
            $validated['name']
        );

        $slug = $baseSlug;

        $counter = 1;

        while (
            Candidate::where(
                'election_id',
                $candidate->election_id
            )
                ->where('slug', $slug)
                ->where('id', '!=', $candidate->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload photo
        |--------------------------------------------------------------------------
        */

        $photoPath = $candidate->photo;

        if ($request->hasFile('photo')) {

            $photoPath = $request
                ->file('photo')
                ->store(
                    'candidates',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $candidate->update([

            'election_position_id' => $position->id,

            'name' => $validated['name'],

            'slug' => $slug,

            'photo' => $photoPath,

            'bio' => $validated['bio'] ?? null,

            'status' => $validated['status'],

        ]);


        return redirect()
            ->route(
                'elections.candidates',
                $candidate->election
            )
            ->with(
                'success',
                'Candidate updated successfully.'
            );
    }


    /**
     * =========================================================
     * DELETE CANDIDATE
     * =========================================================
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->load('election');


        Organization::where(
            'id',
            $candidate->election->organization_id
        )
            ->where(
                'owner_id',
                auth()->id()
            )
            ->firstOrFail();


        $candidate->delete();


        return redirect()
            ->route(
                'elections.candidates',
                $candidate->election
            )
            ->with(
                'success',
                'Candidate removed successfully.'
            );
    }
}