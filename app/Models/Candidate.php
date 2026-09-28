<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BallotSelection;
use App\Models\Certificate;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Relationships
        |--------------------------------------------------------------------------
        */

        'election_id',

        'election_position_id',

        /*
        |--------------------------------------------------------------------------
        | Candidate Information
        |--------------------------------------------------------------------------
        */

        'name',

        'slug',

        'photo',

        'bio',

        'status',

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

    public function position()
    {
        return $this->belongsTo(
            ElectionPosition::class,
            'election_position_id'
        );
    }
	
	/*
|--------------------------------------------------------------------------
| Ballot Selections
|--------------------------------------------------------------------------
*/

public function ballotSelections()
{
    return $this->hasMany(
        BallotSelection::class
    );
}

/*
|--------------------------------------------------------------------------
| Certificates
|--------------------------------------------------------------------------
*/

public function certificates()
{
    return $this->hasMany(
        Certificate::class
    );
}

}