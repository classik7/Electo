<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateImportBatch extends Model
{
    use HasFactory;


    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'election_id',

        'imported_by',

        'file_name',

        'file_path',

        'file_type',

        'total_rows',

        'successful_rows',

        'failed_rows',

        'duplicate_rows',

        'status',

        'errors',

        'completed_at',

    ];


    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'errors' => 'array',

        'completed_at' => 'datetime',

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
    | Imported By
    |--------------------------------------------------------------------------
    */

    public function importedBy()
    {
        return $this->belongsTo(
            User::class,
            'imported_by'
        );
    }
}