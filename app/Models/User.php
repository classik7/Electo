<?php

namespace App\Models;

use Laravel\Passkeys\Contracts\PasskeyUser;
use Laravel\Passkeys\PasskeyAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable implements PasskeyUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, PasskeyAuthenticatable;


    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'status',
        'role',
    ];


    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | User Settings
    |--------------------------------------------------------------------------
    */

    public function settings(): HasOne
    {
        return $this->hasOne(
            UserSetting::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Two-Factor Authentication
    |--------------------------------------------------------------------------
    */

    public function twoFactorAuthentication(): HasOne
    {
        return $this->hasOne(
            TwoFactorAuthentication::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Organizations
    |--------------------------------------------------------------------------
    */

    public function organizations(): HasMany
    {
        return $this->hasMany(
            Organization::class,
            'owner_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Created Elections
    |--------------------------------------------------------------------------
    */

    public function elections(): HasMany
    {
        return $this->hasMany(
            Election::class,
            'created_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Voter
    |--------------------------------------------------------------------------
    */

    public function voter()
    {
        return $this->hasOne(
            Voter::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Unread Notification Count
    |--------------------------------------------------------------------------
    */

    public function unreadNotificationCount(): int
    {
        return $this
            ->unreadNotifications()
            ->count();
    }
}