<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        'user_id',


        /*
        |--------------------------------------------------------------------------
        | Appearance
        |--------------------------------------------------------------------------
        */

        'theme',


        /*
        |--------------------------------------------------------------------------
        | General Notifications
        |--------------------------------------------------------------------------
        */

        'email_notifications',

        'election_notifications',

        'result_notifications',

        'certificate_notifications',

        'security_notifications',


        /*
        |--------------------------------------------------------------------------
        | Election Preferences
        |--------------------------------------------------------------------------
        */

        'election_reminders',

        'election_registration_updates',

        'voting_confirmation',

        'election_closing_reminders',


        /*
        |--------------------------------------------------------------------------
        | Certificate Preferences
        |--------------------------------------------------------------------------
        */

        'certificate_issued_notifications',

        'certificate_status_updates',

        'certificate_verification_updates',

        'certificate_availability_updates',
    ];


    protected $casts = [

        /*
        |--------------------------------------------------------------------------
        | General Notifications
        |--------------------------------------------------------------------------
        */

        'email_notifications' => 'boolean',

        'election_notifications' => 'boolean',

        'result_notifications' => 'boolean',

        'certificate_notifications' => 'boolean',

        'security_notifications' => 'boolean',


        /*
        |--------------------------------------------------------------------------
        | Election Preferences
        |--------------------------------------------------------------------------
        */

        'election_reminders' => 'boolean',

        'election_registration_updates' => 'boolean',

        'voting_confirmation' => 'boolean',

        'election_closing_reminders' => 'boolean',


        /*
        |--------------------------------------------------------------------------
        | Certificate Preferences
        |--------------------------------------------------------------------------
        */

        'certificate_issued_notifications' => 'boolean',

        'certificate_status_updates' => 'boolean',

        'certificate_verification_updates' => 'boolean',

        'certificate_availability_updates' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | User Relationship
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}