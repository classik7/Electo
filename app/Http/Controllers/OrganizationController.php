<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Models\Organization;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display all organizations owned by the authenticated user.
     */
    public function index()
    {
        $search = request('search');

        $organizations = auth()->user()
            ->organizations()
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'electo.organizations.index',
            compact(
                'organizations',
                'search'
            )
        );
    }


    /**
     * Show the create organization form.
     */
    public function create()
    {
        return view(
            'electo.organizations.create'
        );
    }


    /**
     * Store a newly created organization.
     */
    public function store(
        StoreOrganizationRequest $request
    ) {

        Organization::create([

            'owner_id' => auth()->id(),

            'name' => $request->name,

            'slug' =>
                Str::slug($request->name)
                . '-'
                . uniqid(),

            'email' => $request->email,

            'phone' => $request->phone,

            'website' => $request->filled('website')
    ? 'https://' . preg_replace('/^https?:\/\//i', '', trim($request->website))
    : null,

            'country' => $request->country,

            'state' => $request->state,

            'city' => $request->city,

            'address' => $request->address,

            'description' => $request->description,

            'subscription_plan' => 'free',

            'status' => 'active',

        ]);


        return redirect()
            ->route('organizations.index')
            ->with(
                'success',
                'Organization created successfully.'
            );
    }


    /**
     * Display a single organization.
     */
    public function show(
        Organization $organization
    ) {

        abort_if(
            $organization->owner_id !== auth()->id(),
            403
        );


        return view(
            'electo.organizations.show',
            compact('organization')
        );
    }


    /**
     * Show the edit form.
     */
    public function edit(
        Organization $organization
    ) {

        abort_if(
            $organization->owner_id !== auth()->id(),
            403
        );


        return view(
            'electo.organizations.edit',
            compact('organization')
        );
    }


    /**
     * Update the specified organization.
     */
    public function update(
        StoreOrganizationRequest $request,
        Organization $organization
    ) {

        abort_if(
            $organization->owner_id !== auth()->id(),
            403
        );


        $organization->update([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'website' => $request->filled('website')
    ? 'https://' . preg_replace('/^https?:\/\//i', '', trim($request->website))
    : null,

            'country' => $request->country,

            'state' => $request->state,

            'city' => $request->city,

            'address' => $request->address,

            'description' => $request->description,

        ]);


        return redirect()
            ->route(
                'organizations.show',
                $organization
            )
            ->with(
                'success',
                'Organization updated successfully.'
            );
    }


    /**
     * Soft delete an organization.
     */
    public function destroy(
        Organization $organization
    ) {

        abort_if(
            $organization->owner_id !== auth()->id(),
            403
        );


        $organization->delete();


        return redirect()
            ->route('organizations.index')
            ->with(
                'success',
                'Organization moved to trash successfully.'
            );
    }


    /**
     * Display trashed organizations.
     */
    public function trash()
    {
        $organizations = Organization::onlyTrashed()
            ->where(
                'owner_id',
                auth()->id()
            )
            ->latest()
            ->paginate(10);


        return view(
            'electo.organizations.trash',
            compact('organizations')
        );
    }


    /**
     * Restore a soft deleted organization.
     */
    public function restore($id)
    {
        $organization = Organization::onlyTrashed()
            ->where(
                'owner_id',
                auth()->id()
            )
            ->findOrFail($id);


        $organization->restore();


        return redirect()
            ->route('organizations.trash')
            ->with(
                'success',
                'Organization restored successfully.'
            );
    }


    /**
     * Permanently delete an organization.
     */
    public function forceDelete($id)
    {
        $organization = Organization::onlyTrashed()
            ->where(
                'owner_id',
                auth()->id()
            )
            ->findOrFail($id);


        $organization->forceDelete();


        return redirect()
            ->route('organizations.trash')
            ->with(
                'success',
                'Organization permanently deleted.'
            );
    }
}