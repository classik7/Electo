<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ElectionType;
use Illuminate\Http\JsonResponse;

class AdminElectionTypeController extends Controller
{
    /**
     * Get all election types for admin election creation.
     */
    public function index(): JsonResponse
    {
        $types = ElectionType::with('category')
            ->withCount('elections')
            ->orderBy('name')
            ->get()
            ->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'description' => $type->description,
                    'category' => $type->category
                        ? [
                            'id' => $type->category->id,
                            'name' => $type->category->name,
                        ]
                        : null,
                    'elections_count' => $type->elections_count,
                ];
            });

        return response()->json([
            'success' => true,
            'election_types' => $types,
        ]);
    }
}