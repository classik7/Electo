<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\NotificationService;

class ElectionController extends Controller
{
    /**
     * Display all elections.
     */
    public function index(Request $request)
    {
        $organizationIds = auth()->user()
            ->organizations()
            ->pluck('id');

        $query = Election::with([
            'organization',
            'electionType',
        ])
            ->whereIn('organization_id', $organizationIds)
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )
                ->orWhereHas(
                    'organization',
                    function ($organization) use ($search) {

                        $organization->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        |
        | Draft is intentionally removed.
        |
        */

        if ($request->filled('status')) {

            $status = $request->status;

            if ($status === 'published') {

                $query->where(
                    'status',
                    'published'
                );

            } elseif ($status === 'cancelled') {

                $query->where(
                    'status',
                    'cancelled'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Paginated Elections
        |--------------------------------------------------------------------------
        */

        $elections = $query
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $allElections = Election::whereIn(
            'organization_id',
            $organizationIds
        )->get();

        $totalElections =
            $allElections->count();

        $activeElections =
            $allElections
                ->filter(
                    fn ($election) =>
                        $election->isOngoing()
                )
                ->count();

        $scheduledElections =
            $allElections
                ->filter(
                    fn ($election) =>
                        $election->isScheduled()
                )
                ->count();

        $completedElections =
            $allElections
                ->filter(
                    fn ($election) =>
                        $election->isCompleted()
                )
                ->count();

        return view(
            'electo.elections.index',
            compact(
                'elections',
                'totalElections',
                'activeElections',
                'scheduledElections',
                'completedElections'
            )
        );
    }


    /**
     * Step 1 - Create Election Wizard.
     */
    public function create(Request $request)
    {
        $organizations = auth()->user()
            ->organizations()
            ->orderBy('name')
            ->get();

        $electionTypes = ElectionType::with('category')
            ->withCount('elections')
            ->orderBy('name')
            ->get()
            ->groupBy('category_id');

        $selectedType = null;

        if ($request->filled('type')) {

            $selectedType = ElectionType::with('category')
                ->withCount('elections')
                ->find($request->type);
        }

        return view(
            'electo.elections.create',
            compact(
                'organizations',
                'electionTypes',
                'selectedType'
            )
        );
    }


    /**
     * Step 2 - Election Details.
     */
    public function details(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                'integer',
                'exists:election_types,id',
            ],
        ]);

        $selectedType = ElectionType::with('category')
            ->withCount('elections')
            ->findOrFail($request->type);

        $organizations = auth()->user()
            ->organizations()
            ->orderBy('name')
            ->get();

        return view(
            'electo.elections.details',
            compact(
                'selectedType',
                'organizations'
            )
        );
    }


    /**
     * Step 3 - Election Schedule.
     */
    public function schedule(Request $request)
    {
        $selectedType = ElectionType::with('category')
            ->withCount('elections')
            ->findOrFail($request->type);

        $organization = auth()->user()
            ->organizations()
            ->findOrFail(
                $request->organization
            );

        return view(
            'electo.elections.schedule',
            [
                'selectedType' =>
                    $selectedType,

                'organization' =>
                    $organization,

                'electionTitle' =>
                    $request->title,

                'description' =>
                    $request->description,

                'visibility' =>
                    $request->visibility ?? 'Private',
            ]
        );
    }


    /**
     * Step 4 - Election Positions.
     */
    public function positions(Request $request)
    {
        $request->validate([
            'type' => [
                'required',
                'integer',
                'exists:election_types,id',
            ],

            'organization' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $selectedType = ElectionType::with('category')
            ->withCount('elections')
            ->findOrFail(
                $request->type
            );

        $organization = auth()->user()
            ->organizations()
            ->findOrFail(
                $request->organization
            );

        return view(
            'electo.elections.positions',
            [
                'selectedType' =>
                    $selectedType,

                'organization' =>
                    $organization,

                'electionTitle' =>
                    $request->title,

                'description' =>
                    $request->description,

                'visibility' =>
                    $request->visibility ?? 'private',

                'startsAt' =>
                    $request->start_date
                    . ' '
                    . ($request->start_time ?? '00:00'),

                'endsAt' =>
                    $request->end_date
                    . ' '
                    . ($request->end_time ?? '00:00'),
            ]
        );
    }


    /**
     * Display candidates for an election.
     */
    public function candidates(Election $election)
    {
        auth()->user()
            ->organizations()
            ->findOrFail(
                $election->organization_id
            );

        $election->load([
            'organization',
            'electionType',
            'positions.candidates',
        ]);

        return view(
            'electo.elections.candidates',
            compact('election')
        );
    }


    /**
     * Store completed election.
     *
     * New elections are created as published.
     *
     * Their actual display state is determined from
     * the start and end dates:
     *
     * Future start  = Scheduled
     * Current period = Active
     * Past end      = Completed
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Normalize Visibility
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'visibility' => strtolower(
                $request->input(
                    'visibility',
                    'private'
                )
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'type' => [
                'required',
                'integer',
                'exists:election_types,id',
            ],

            'organization' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'visibility' => [
                'required',
                'in:public,private',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
            ],

            'end_date' => [
                'required',
                'date',
            ],

            'end_time' => [
                'required',
            ],

            'positions' => [
                'required',
                'array',
                'min:1',
            ],

            'positions.*' => [
                'required',
                'string',
                'max:255',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify Organization Ownership
        |--------------------------------------------------------------------------
        */

        $organization = auth()->user()
            ->organizations()
            ->findOrFail(
                $validated['organization']
            );

        /*
        |--------------------------------------------------------------------------
        | Verify Election Type
        |--------------------------------------------------------------------------
        */

        $electionType =
            ElectionType::findOrFail(
                $validated['type']
            );

        /*
        |--------------------------------------------------------------------------
        | Build Start / End DateTime
        |--------------------------------------------------------------------------
        */

        $startsAt =
            $validated['start_date']
            . ' '
            . $validated['start_time'];

        $endsAt =
            $validated['end_date']
            . ' '
            . $validated['end_time'];

        /*
        |--------------------------------------------------------------------------
        | Validate Schedule
        |--------------------------------------------------------------------------
        */

        if (
            strtotime($endsAt)
            <=
            strtotime($startsAt)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'end_date' =>
                        'The election end date and time must be after the start date and time.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $baseSlug =
            Str::slug(
                $validated['title']
            );

        $slug = $baseSlug;

        $counter = 1;

        while (
            Election::withTrashed()
                ->where('slug', $slug)
                ->exists()
        ) {

            $slug =
                $baseSlug
                . '-'
                . $counter;

            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Election
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | New elections are published immediately.
        |
        */

        $election = Election::create([

            'organization_id' =>
                $organization->id,

            'election_type_id' =>
                $electionType->id,

            'created_by' =>
                auth()->id(),

            'title' =>
                $validated['title'],

            'slug' =>
                $slug,

            'description' =>
                $validated['description']
                ?? null,

            'starts_at' =>
                $startsAt,

            'ends_at' =>
                $endsAt,

            'visibility' =>
                $validated['visibility'],

            'status' =>
                'published',

            'allow_multiple_votes' =>
                false,

            'show_live_results' =>
                false,

            'require_voter_verification' =>
                true,

            'allow_result_download' =>
                true,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Save Election Positions
        |--------------------------------------------------------------------------
        */

        foreach (
            $validated['positions']
            as $index => $positionName
        ) {

            $positionName =
                trim($positionName);

            if (
                $positionName === ''
            ) {
                continue;
            }

            $election->positions()->create([

                'name' =>
                    $positionName,

                'description' =>
                    null,

                'sort_order' =>
                    $index + 1,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Election Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            auth()->user(),

            'Election Created',

            "Your election \"{$election->title}\" has been created and scheduled successfully.",

            'election',

            route(
                'elections.show',
                $election
            ),

            'vote'
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect To Election
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'elections.show',
                $election
            )
            ->with(
                'success',
                'Election created and scheduled successfully.'
            );
    }


    /**
     * Display election.
     */
    public function show(Election $election)
    {
        $election->load([
            'organization',
            'electionType',
            'positions',
        ]);

        return view(
            'electo.elections.show',
            compact('election')
        );
    }


    /**
     * Edit election.
     */
    public function edit(Election $election)
    {
        auth()->user()
            ->organizations()
            ->findOrFail(
                $election->organization_id
            );

        $election->load([
            'organization',
            'electionType.category',
            'positions',
        ]);

        $organizations = auth()->user()
            ->organizations()
            ->orderBy('name')
            ->get();

        return view(
            'electo.elections.edit',
            compact(
                'election',
                'organizations'
            )
        );
    }


    /**
     * Update election.
     */
    public function update(
        Request $request,
        Election $election
    ) {

        /*
        |--------------------------------------------------------------------------
        | Verify Ownership
        |--------------------------------------------------------------------------
        */

        auth()->user()
            ->organizations()
            ->findOrFail(
                $election->organization_id
            );

        /*
        |--------------------------------------------------------------------------
        | Normalize Visibility
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'visibility' => strtolower(
                $request->input(
                    'visibility',
                    'private'
                )
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'type' => [
                'required',
                'integer',
                'exists:election_types,id',
            ],

            'organization' => [
                'required',
                'integer',
                'exists:organizations,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'visibility' => [
                'required',
                'in:public,private',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
            ],

            'end_date' => [
                'required',
                'date',
            ],

            'end_time' => [
                'required',
            ],

            'positions' => [
                'required',
                'array',
                'min:1',
            ],

            'positions.*' => [
                'required',
                'string',
                'max:255',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify New Organization Ownership
        |--------------------------------------------------------------------------
        */

        $organization = auth()->user()
            ->organizations()
            ->findOrFail(
                $validated['organization']
            );

        /*
        |--------------------------------------------------------------------------
        | Build Schedule
        |--------------------------------------------------------------------------
        */

        $startsAt =
            $validated['start_date']
            . ' '
            . $validated['start_time'];

        $endsAt =
            $validated['end_date']
            . ' '
            . $validated['end_time'];

        /*
        |--------------------------------------------------------------------------
        | Validate Schedule
        |--------------------------------------------------------------------------
        */

        if (
            strtotime($endsAt)
            <=
            strtotime($startsAt)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'end_date' =>
                        'The election end date and time must be after the start date and time.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Election
        |--------------------------------------------------------------------------
        |
        | Keep the election published unless it was explicitly cancelled.
        |
        */

        $election->update([

            'organization_id' =>
                $organization->id,

            'election_type_id' =>
                $validated['type'],

            'title' =>
                $validated['title'],

            'description' =>
                $validated['description']
                ?? null,

            'starts_at' =>
                $startsAt,

            'ends_at' =>
                $endsAt,

            'visibility' =>
                $validated['visibility'],

            'status' =>
                $election->status === 'cancelled'
                    ? 'cancelled'
                    : 'published',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Positions
        |--------------------------------------------------------------------------
        */

        $election->positions()->delete();

        foreach (
            $validated['positions']
            as $index => $positionName
        ) {

            $positionName =
                trim($positionName);

            if (
                $positionName === ''
            ) {
                continue;
            }

            $election->positions()->create([

                'name' =>
                    $positionName,

                'description' =>
                    null,

                'sort_order' =>
                    $index + 1,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Election Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            auth()->user(),

            'Election Updated',

            "Your election \"{$election->title}\" has been updated successfully.",

            'election',

            route(
                'elections.show',
                $election
            ),

            'vote'
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'elections.show',
                $election
            )
            ->with(
                'success',
                'Election updated successfully.'
            );
    }


    /**
     * Delete election.
     */
    public function destroy(Election $election)
    {
        auth()->user()
            ->organizations()
            ->findOrFail(
                $election->organization_id
            );

        /*
        |--------------------------------------------------------------------------
        | Prevent deleting a published election
        |--------------------------------------------------------------------------
        */

        if (
            $election->status === 'published'
        ) {

            return back()->withErrors([
                'election' =>
                    'A published election cannot be deleted. Cancel the election first.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Soft Delete
        |--------------------------------------------------------------------------
        */

        $election->delete();

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('elections.index')
            ->with(
                'success',
                'Election deleted successfully.'
            );
    }
}