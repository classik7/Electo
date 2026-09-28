<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [

        'election_id',

        'candidate_id',

        'election_position_id',

        'certificate_number',

        'verification_code',

        'issued_at',

        'issued_by',

        'status',

    ];


    protected $casts = [

        'issued_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | Election
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
    | Winner / Candidate
    |--------------------------------------------------------------------------
    */

    public function candidate()
    {
        return $this->belongsTo(
            Candidate::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Position
    |--------------------------------------------------------------------------
    */

    public function position()
    {
        return $this->belongsTo(
            ElectionPosition::class,
            'election_position_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Issued By
    |--------------------------------------------------------------------------
    */

    public function issuer()
    {
        return $this->belongsTo(
            User::class,
            'issued_by'
        );
    }
}