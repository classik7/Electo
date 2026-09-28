<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display organizations owned by the authenticated user.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $search = trim((string) $request->query('search', ''));

        $organizations = $user->organizations()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Organizations retrieved successfully.',
            'data' => $organizations->map(function (Organization $organization) {
                return $this->organizationData($organization);
            })->values(),
        ]);
    }

    /**
     * Display a single organization.
     */
    public function show(Request $request, Organization $organization): JsonResponse
    {
        $this->authorizeOwner($request, $organization);

        return response()->json([
            'success' => true,
            'message' => 'Organization retrieved successfully.',
            'data' => $this->organizationData($organization),
        ]);
    }

    /**
     * Create a new organization.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'website' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'string',
                'max:100',
            ],
            'state' => [
                'nullable',
                'string',
                'max:100',
            ],
            'city' => [
                'nullable',
                'string',
                'max:100',
            ],
            'address' => [
                'nullable',
                'string',
                'max:500',
            ],
            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the highlighted fields.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $organization = Organization::create([
            'owner_id' => $request->user()->id,
            'name' => $request->string('name')->trim()->toString(),
            'slug' => Str::slug($request->string('name')->trim()->toString())
                . '-'
                . uniqid(),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $this->normalizeWebsite(
                $request->input('website')
            ),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'subscription_plan' => 'free',
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Organization created successfully.',
            'data' => $this->organizationData($organization),
        ], 201);
    }

    /**
     * Update an organization.
     */
    public function update(
        Request $request,
        Organization $organization
    ): JsonResponse {
        $this->authorizeOwner($request, $organization);

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'website' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'string',
                'max:100',
            ],
            'state' => [
                'nullable',
                'string',
                'max:100',
            ],
            'city' => [
                'nullable',
                'string',
                'max:100',
            ],
            'address' => [
                'nullable',
                'string',
                'max:500',
            ],
            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please correct the highlighted fields.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $organization->update([
            'name' => $request->string('name')->trim()->toString(),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $this->normalizeWebsite(
                $request->input('website')
            ),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
        ]);

        $organization->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Organization updated successfully.',
            'data' => $this->organizationData($organization),
        ]);
    }

    /**
     * Soft-delete an organization.
     */
    public function destroy(
        Request $request,
        Organization $organization
    ): JsonResponse {
        $this->authorizeOwner($request, $organization);

        $organization->delete();

        return response()->json([
            'success' => true,
            'message' => 'Organization moved to trash successfully.',
        ]);
    }

    /**
     * Make sure the authenticated user owns the organization.
     */
    private function authorizeOwner(
        Request $request,
        Organization $organization
    ): void {
        abort_if(
            $organization->owner_id !== $request->user()->id,
            403,
            'You are not authorized to access this organization.'
        );
    }

    /**
     * Normalize website URLs.
     */
    private function normalizeWebsite(?string $website): ?string
    {
        if (!$website) {
            return null;
        }

        $website = trim($website);

        if ($website === '') {
            return null;
        }

        return 'https://' . preg_replace(
            '/^https?:\/\//i',
            '',
            $website
        );
    }

    /**
     * Return the public organization payload.
     */
    private function organizationData(
        Organization $organization
    ): array {
        return [
            'id' => $organization->id,
            'name' => $organization->name,
            'slug' => $organization->slug,
            'email' => $organization->email,
            'phone' => $organization->phone,
            'website' => $organization->website,
            'country' => $organization->country,
            'state' => $organization->state,
            'city' => $organization->city,
            'address' => $organization->address,
            'description' => $organization->description,
            'status' => $organization->status,
            'subscription_plan' => $organization->subscription_plan,
            'verified_at' => $organization->verified_at?->toISOString(),
            'created_at' => $organization->created_at?->toISOString(),
            'updated_at' => $organization->updated_at?->toISOString(),
        ];
    }
}