<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BallotSelection;

class ElectionPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'name',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
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

    public function candidates()
    {
        return $this->hasMany(
            Candidate::class,
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
}