<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | User Account
        |--------------------------------------------------------------------------
        */

        'user_id',

        /*
        |--------------------------------------------------------------------------
        | Voter Identity
        |--------------------------------------------------------------------------
        */

        'name',

        'voter_id',

        'email',

        'phone',

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        'photo',

        /*
        |--------------------------------------------------------------------------
        | Verification / Status
        |--------------------------------------------------------------------------
        */

        'status',

        'verified_at',

    ];


    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'verified_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | User Account
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Election Relationships
    |--------------------------------------------------------------------------
    */

    public function electionVoters()
    {
        return $this->hasMany(
            ElectionVoter::class
        );
    }


    public function elections()
    {
        return $this->belongsToMany(
            Election::class,
            'election_voters'
        )
        ->withPivot([
            'is_eligible',
            'accreditation_status',
            'accredited_at',
            'accreditation_method',
            'has_voted',
            'voted_at',
        ])
        ->withTimestamps();
    }


    /*
    |--------------------------------------------------------------------------
    | Voting Sessions
    |--------------------------------------------------------------------------
    */

    public function votingSessions()
    {
        return $this->hasMany(
            VotingSession::class
        );
    }
}