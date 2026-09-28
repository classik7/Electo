<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionType;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminElectionController extends Controller
{
    /**
     * Create a new election from the mobile/admin application.
     */
    public function store(Request $request): JsonResponse
    {        /*
        |--------------------------------------------------------------------------
        | ADMIN ROLE AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        if (!$user->hasAnyRole([
            'Super Admin',
            'Platform Admin',
            'Organization Owner',
            'Election Manager',
        ])) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to create elections.',
            ], 403);
        }
        /*
        |--------------------------------------------------------------------------
        | Normalize Visibility
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'visibility' => strtolower(
                $request->input('visibility', 'private')
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
                'date_format:H:i',
            ],

            'end_date' => [
                'required',
                'date',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
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

                /*
        |--------------------------------------------------------------------------
        | ORGANIZATION AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        $organization = null;

        if ($user->hasAnyRole([
            'Super Admin',
            'Platform Admin',
        ])) {
            $organization = \App\Models\Organization::find(
                $validated['organization']
            );
        } else {
            $organization = $user
                ->organizations()
                ->find($validated['organization']);
        }

        if (!$organization) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have access to the selected organization.',
            ], 403);
        }

        if (!$organization) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to create an election for this organization.',
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Verify Election Type
        |--------------------------------------------------------------------------
        */

        $electionType = ElectionType::find($validated['type']);

        if (!$electionType) {
            return response()->json([
                'success' => false,
                'message' => 'The selected election type does not exist.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Build Schedule
        |--------------------------------------------------------------------------
        */

        $startsAt = $validated['start_date']
            . ' '
            . $validated['start_time'];

        $endsAt = $validated['end_date']
            . ' '
            . $validated['end_time'];

        /*
        |--------------------------------------------------------------------------
        | Validate Schedule
        |--------------------------------------------------------------------------
        */

        if (strtotime($endsAt) <= strtotime($startsAt)) {
            return response()->json([
                'success' => false,
                'message' => 'The election end date and time must be after the start date and time.',
                'errors' => [
                    'end_date' => [
                        'The election end date and time must be after the start date and time.',
                    ],
                ],
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['title']);

        if ($baseSlug === '') {
            $baseSlug = 'election';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            Election::withTrashed()
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Election + Positions Atomically
        |--------------------------------------------------------------------------
        */

        try {
            $election = DB::transaction(function () use (
                $validated,
                $organization,
                $electionType,
                $startsAt,
                $endsAt,
                $slug,
                $request
            ) {
                $election = Election::create([
                    'organization_id' => $organization->id,

                    'election_type_id' => $electionType->id,

                    'created_by' => $request->user()->id,

                    'title' => $validated['title'],

                    'slug' => $slug,

                    'description' => $validated['description'] ?? null,

                    'starts_at' => $startsAt,

                    'ends_at' => $endsAt,

                    'visibility' => $validated['visibility'],

                    'status' => 'published',

                    'allow_multiple_votes' => false,

                    'show_live_results' => false,

                    'require_voter_verification' => true,

                    'allow_result_download' => true,
                ]);

                foreach ($validated['positions'] as $index => $positionName) {
                    $positionName = trim($positionName);

                    if ($positionName === '') {
                        continue;
                    }

                    $election->positions()->create([
                        'name' => $positionName,

                        'description' => null,

                        'sort_order' => $index + 1,
                    ]);
                }

                return $election;
            });

            /*
            |--------------------------------------------------------------------------
            | Notification
            |--------------------------------------------------------------------------
            */

            NotificationService::send(
                $request->user(),

                'Election Created',

                "Your election \"{$election->title}\" has been created and scheduled successfully.",

                'election',

                route('elections.show', $election),

                'vote'
            );

            /*
            |--------------------------------------------------------------------------
            | Load Response Data
            |--------------------------------------------------------------------------
            */

            $election->load([
                'organization',
                'electionType',
                'positions',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Success Response
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,

                'message' => 'Election created and scheduled successfully.',

                'election' => [
                    'id' => $election->id,

                    'title' => $election->title,

                    'slug' => $election->slug,

                    'description' => $election->description,

                    'organization_id' => $election->organization_id,

                    'organization' => $election->organization
                        ? [
                            'id' => $election->organization->id,
                            'name' => $election->organization->name,
                        ]
                        : null,

                    'election_type_id' => $election->election_type_id,

                    'election_type' => $election->electionType
                        ? [
                            'id' => $election->electionType->id,
                            'name' => $election->electionType->name,
                        ]
                        : null,

                    'visibility' => $election->visibility,

                    'status' => 'upcoming',

                    'starts_at' => $election->starts_at,

                    'ends_at' => $election->ends_at,

                    'positions' => $election->positions
                        ->map(function ($position) {
                            return [
                                'id' => $position->id,
                                'name' => $position->name,
                                'description' => $position->description,
                                'sort_order' => $position->sort_order,
                            ];
                        })
                        ->values(),
                ],
            ], 201);

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to create the election at this time.',
            ], 500);
        }
    }
}