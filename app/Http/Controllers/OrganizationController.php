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
        $organizations = auth()->user()
            ->ownedOrganizations()
            ->latest()
            ->get();

        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the create organization form.
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created organization.
     */
    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create([
            'owner_id' => auth()->id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'description' => $request->description,
            'verification_status' => 'pending',
            'subscription_plan' => 'free',
            'status' => 'active',
        ]);

        return redirect()
            ->route('organizations.index')
            ->with('success', 'Organization created successfully.');
    }
}