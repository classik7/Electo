<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotSelection extends Model
{
    use HasFactory;

    protected $fillable = [

        'ballot_id',

        'election_position_id',

        'candidate_id',

    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function ballot()
    {
        return $this->belongsTo(Ballot::class);
    }


    public function position()
    {
        return $this->belongsTo(
            ElectionPosition::class,
            'election_position_id'
        );
    }


    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}