<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Election extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Relationships
        |--------------------------------------------------------------------------
        */

        'organization_id',

        'election_type_id',

        'created_by',

        /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */

        'title',

        'slug',

        'description',

        /*
        |--------------------------------------------------------------------------
        | Branding
        |--------------------------------------------------------------------------
        */

        'logo',

        'banner',

        /*
        |--------------------------------------------------------------------------
        | Schedule
        |--------------------------------------------------------------------------
        */

        'starts_at',

        'ends_at',

        'published_at',

        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        'visibility',

        'status',

        'allow_multiple_votes',

        'show_live_results',

        'require_voter_verification',

        'allow_result_download',

    ];


    protected $casts = [

        'starts_at' => 'datetime',

        'ends_at' => 'datetime',

        'published_at' => 'datetime',

        'allow_multiple_votes' => 'boolean',

        'show_live_results' => 'boolean',

        'require_voter_verification' => 'boolean',

        'allow_result_download' => 'boolean',

    ];


    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    */

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Election Type
    |--------------------------------------------------------------------------
    */

    public function electionType()
    {
        return $this->belongsTo(ElectionType::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Creator
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    /*
    |--------------------------------------------------------------------------
    | Election Positions
    |--------------------------------------------------------------------------
    */

    public function positions()
    {
        return $this->hasMany(ElectionPosition::class)
            ->orderBy('sort_order');
    }


    /*
    |--------------------------------------------------------------------------
    | Election Voters
    |--------------------------------------------------------------------------
    */

    public function electionVoters()
    {
        return $this->hasMany(ElectionVoter::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Voters
    |--------------------------------------------------------------------------
    */

    public function voters()
    {
        return $this->belongsToMany(
            Voter::class,
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
    | Voting Stations
    |--------------------------------------------------------------------------
    */

    public function votingStations()
    {
        return $this->hasMany(VotingStation::class);
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


    /*
    |--------------------------------------------------------------------------
    | Candidates
    |--------------------------------------------------------------------------
    */

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Ballots
    |--------------------------------------------------------------------------
    |
    | A ballot represents a submitted voting record.
    |
    */

    public function ballots()
    {
        return $this->hasMany(Ballot::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Certificates
    |--------------------------------------------------------------------------
    */

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }


    public function isPublished(): bool
    {
        return $this->status === 'published';
    }


    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }


    public function isScheduled(): bool
    {
        return $this->isPublished()
            && $this->starts_at
            && now()->lt($this->starts_at);
    }


    public function isOngoing(): bool
    {
        return $this->isPublished()
            && $this->starts_at
            && $this->ends_at
            && now()->between(
                $this->starts_at,
                $this->ends_at
            );
    }


    public function isCompleted(): bool
    {
        return $this->isPublished()
            && $this->ends_at
            && now()->gt($this->ends_at);
    }
}