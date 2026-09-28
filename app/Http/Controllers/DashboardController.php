<?php

namespace App\Http\Controllers;

use App\Models\Organization;

class DashboardController extends Controller
{
    public function index()
    {
        $organizationCount = auth()->user()
            ->Organizations()
            ->count();

        return view('electo.pages.dashboard', [
            'organizationCount' => $organizationCount,
            'activeElectionCount' => 0,
            'registeredVoterCount' => 0,
            'votesCastCount' => 0,
        ]);
    }
}