<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingStation extends Model
{
    use HasFactory;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Election
        |--------------------------------------------------------------------------
        */

        'election_id',


        /*
        |--------------------------------------------------------------------------
        | Station Identity
        |--------------------------------------------------------------------------
        */

        'name',

        'code',

        'location',


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        'status',

        'is_public',

    ];


    protected $casts = [

        'is_public' => 'boolean',

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
	
	/*
|--------------------------------------------------------------------------
| Voting Sessions
|--------------------------------------------------------------------------
*/

public function votingSessions()
{
    return $this->hasMany(VotingSession::class);
}
}