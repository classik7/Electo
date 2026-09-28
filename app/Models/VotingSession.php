<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ballot;

class VotingSession extends Model
{
    use HasFactory;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Relationships
        |--------------------------------------------------------------------------
        */

        'election_id',

        'voter_id',

        'voting_station_id',


        /*
        |--------------------------------------------------------------------------
        | Voting Method
        |--------------------------------------------------------------------------
        */

        'voting_method',


        /*
        |--------------------------------------------------------------------------
        | Session Status
        |--------------------------------------------------------------------------
        */

        'status',

        'session_token',


        /*
        |--------------------------------------------------------------------------
        | Session Timing
        |--------------------------------------------------------------------------
        */

        'authenticated_at',

        'ballot_opened_at',

        'submitted_at',

        'completed_at',

        'expires_at',


        /*
        |--------------------------------------------------------------------------
        | Device Information
        |--------------------------------------------------------------------------
        */

        'device_identifier',

        'ip_address',

        'user_agent',

    ];


    protected $casts = [

        'authenticated_at' => 'datetime',

        'ballot_opened_at' => 'datetime',

        'submitted_at' => 'datetime',

        'completed_at' => 'datetime',

        'expires_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function election()
    {
        return $this->belongsTo(Election::class);
    }


    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }


    public function votingStation()
    {
        return $this->belongsTo(
            VotingStation::class
        );
    }
	
	/*
|--------------------------------------------------------------------------
| Ballot
|--------------------------------------------------------------------------
*/

public function ballot()
{
    return $this->hasOne(Ballot::class);
}

}