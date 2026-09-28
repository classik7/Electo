<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    use HasFactory;

    protected $fillable = [

        'election_id',

        'voting_session_id',

        'status',

        'submitted_at',

    ];


    protected $casts = [

        'submitted_at' => 'datetime',

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


    public function votingSession()
    {
        return $this->belongsTo(VotingSession::class);
    }


    public function selections()
    {
        return $this->hasMany(BallotSelection::class);
    }
}