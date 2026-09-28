<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ballot_selections', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Ballot
            |--------------------------------------------------------------------------
            */

            $table->foreignId('ballot_id')
                ->constrained('ballots')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Election Position
            |--------------------------------------------------------------------------
            */

            $table->foreignId('election_position_id')
                ->constrained('election_positions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Selected Candidate
            |--------------------------------------------------------------------------
            */

            $table->foreignId('candidate_id')
                ->constrained('candidates')
                ->cascadeOnDelete();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | One Selection Per Position
            |--------------------------------------------------------------------------
            |
            | This currently means one candidate can be selected for
            | each position on a ballot.
            |
            */

            $table->unique([
                'ballot_id',
                'election_position_id',
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ballot_selections');
    }
};