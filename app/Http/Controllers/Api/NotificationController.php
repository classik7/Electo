<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Get authenticated user's notifications.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $notifications = $user->notifications()
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,

            'unread_count' => $user->unreadNotifications()->count(),

            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,

                    'type' => $notification->data['type']
                        ?? null,

                    'title' => $notification->data['title']
                        ?? 'Notification',

                    'message' => $notification->data['message']
                        ?? null,

                    'action_url' => $notification->data['action_url']
                        ?? null,

                    'icon' => $notification->data['icon']
                        ?? null,

                    'read_at' => $notification->read_at,

                    'is_read' => !is_null(
                        $notification->read_at
                    ),

                    'created_at' => $notification->created_at,
                ];
            }),

            'pagination' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'per_page' => $notifications->perPage(),
                'total' => $notifications->total(),
            ],
        ]);
    }


    /**
     * Get unread notification count.
     */
    public function unreadCount(Request $request): JsonResponse
    {
        $count = $request->user()
            ->unreadNotifications()
            ->count();

        return response()->json([
            'success' => true,
            'unread_count' => $count,
        ]);
    }


    /**
     * Mark one notification as read.
     */
    public function markAsRead(
        Request $request,
        DatabaseNotification $notification
    ): JsonResponse {

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | A user must only be able to modify their own notification.
        |--------------------------------------------------------------------------
        */

        if ($notification->notifiable_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to modify this notification.',
            ], 403);
        }

        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read.',
            'unread_count' => $user->unreadNotifications()->count(),
        ]);
    }


    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read.',
            'unread_count' => 0,
        ]);
    }
}