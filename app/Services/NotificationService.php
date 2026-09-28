<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\ElectoNotification;

class NotificationService
{
    /**
     * Send an Electo database notification.
     *
     * The notification category is checked against
     * the user's notification preferences before
     * anything is created.
     */
    public static function send(
        User $user,
        string $title,
        string $message,
        string $type = 'general',
        ?string $url = null,
        ?string $icon = null
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | Check notification preference
        |--------------------------------------------------------------------------
        */

        if (!self::isEnabled($user, $type)) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | Create notification
        |--------------------------------------------------------------------------
        */

        $user->notify(
            new ElectoNotification(
                title: $title,
                message: $message,
                type: $type,
                url: $url,
                icon: $icon
            )
        );


        return true;
    }


    /**
     * Determine whether a notification category is enabled.
     */
    public static function isEnabled(
        User $user,
        string $type
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | Load user's settings
        |--------------------------------------------------------------------------
        */

        $settings = $user->settings;


        /*
        |--------------------------------------------------------------------------
        | If settings don't exist, allow notifications.
        |--------------------------------------------------------------------------
        |
        | This prevents notification delivery from silently breaking
        | for an account that does not yet have a settings record.
        |
        */

        if (!$settings) {
            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | Map notification type to user setting
        |--------------------------------------------------------------------------
        */

        $preferenceMap = [

            'general' => 'email_notifications',

            'election' => 'election_notifications',

            'result' => 'result_notifications',

            'certificate' => 'certificate_notifications',

            'security' => 'security_notifications',

        ];


        /*
        |--------------------------------------------------------------------------
        | Unknown notification type
        |--------------------------------------------------------------------------
        |
        | Unknown types are allowed so future Electo features don't
        | unexpectedly fail simply because a new category hasn't
        | been added to the preference map yet.
        |
        */

        if (!array_key_exists($type, $preferenceMap)) {
            return true;
        }


        $setting =
            $preferenceMap[$type];


        return (bool) $settings->{$setting};
    }
}