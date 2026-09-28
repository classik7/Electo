<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionVoter extends Model
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

        /*
        |--------------------------------------------------------------------------
        | Eligibility
        |--------------------------------------------------------------------------
        */

        'is_eligible',

        /*
        |--------------------------------------------------------------------------
        | Accreditation
        |--------------------------------------------------------------------------
        */

        'accreditation_status',

        'accredited_at',

        'accredited_by',

        'accreditation_method',

        'accreditation_reference',

        /*
        |--------------------------------------------------------------------------
        | Voting Status
        |--------------------------------------------------------------------------
        */

        'has_voted',

        'voted_at',

    ];


    protected $casts = [

        'is_eligible' => 'boolean',

        'accredited_at' => 'datetime',

        'has_voted' => 'boolean',

        'voted_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Election Relationship
    |--------------------------------------------------------------------------
    */

    public function election()
    {
        return $this->belongsTo(
            Election::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Voter Relationship
    |--------------------------------------------------------------------------
    */

    public function voter()
    {
        return $this->belongsTo(
            Voter::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Accreditation Administrator
    |--------------------------------------------------------------------------
    */

    public function accreditedBy()
    {
        return $this->belongsTo(
            User::class,
            'accredited_by'
        );
    }
}