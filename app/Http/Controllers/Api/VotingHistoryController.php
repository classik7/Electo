<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VotingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VotingHistoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $voter = $user->voter;

        if (!$voter) {
            return response()->json([
                'success' => false,
                'message' => 'Voter profile not found.',
            ], 404);
        }

        $sessions = VotingSession::query()
            ->where('voter_id', $voter->id)
            ->whereNotNull('submitted_at')
            ->where('status', 'submitted')
            ->with([
                'election',
                'ballot.selections.position',
                'ballot.selections.candidate',
            ])
            ->latest('submitted_at')
            ->get();

        $history = $sessions->map(function ($session) {
            $ballot = $session->ballot;

            return [
                'session_id' => $session->id,

                'election' => [
                    'id' => $session->election?->id,
                    'title' => $session->election?->title,
                    'slug' => $session->election?->slug,
                    'logo' => $session->election?->logo,
                    'starts_at' => $session->election?->starts_at,
                    'ends_at' => $session->election?->ends_at,
                ],

                'submitted_at' => $session->submitted_at,
                'completed_at' => $session->completed_at,

                'voting_method' => $session->voting_method,

                'selections' => $ballot
                    ? $ballot->selections->map(function ($selection) {
                        return [
                            'position_id' => $selection->election_position_id,
                            'position' => $selection->position?->name,

                            'candidate_id' => $selection->candidate_id,
                            'candidate' => $selection->candidate?->name,
                            'candidate_photo' => $selection->candidate?->photo,
                        ];
                    })->values()
                    : [],
            ];
        })->values();

        return response()->json([
            'success' => true,
            'total' => $history->count(),
            'history' => $history,
        ]);
    }
}