<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Mark one notification as read.
     */
    public function markAsRead(
        Request $request,
        DatabaseNotification $notification
    ) {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        |
        | Make sure the notification belongs to the authenticated user.
        |
        */

        if (
            $notification->notifiable_type !== get_class($user) ||
            (int) $notification->notifiable_id !== (int) $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Mark As Read
        |--------------------------------------------------------------------------
        */

        if (is_null($notification->read_at)) {

            $notification->markAsRead();

        }


        /*
        |--------------------------------------------------------------------------
        | Get Updated Unread Count
        |--------------------------------------------------------------------------
        */

        $unreadCount = $user
            ->unreadNotifications()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | AJAX / JSON Response
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read.',
                'notification_id' => $notification->id,
                'unread_count' => $unreadCount,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Normal Request
        |--------------------------------------------------------------------------
        */

        return back();
    }


    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Mark All Unread Notifications As Read
        |--------------------------------------------------------------------------
        */

        $user
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | AJAX / JSON Response
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read.',
                'unread_count' => 0,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Normal Request
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }
}