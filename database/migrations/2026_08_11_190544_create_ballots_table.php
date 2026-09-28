<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ballots', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Election
            |--------------------------------------------------------------------------
            */

            $table->foreignId('election_id')
                ->constrained('elections')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Voting Session
            |--------------------------------------------------------------------------
            |
            | One voting session can create only one ballot.
            |
            */

            $table->foreignId('voting_session_id')
                ->constrained('voting_sessions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Ballot Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'draft',
                'submitted',
                'void',
            ])->default('draft');


            /*
            |--------------------------------------------------------------------------
            | Submission
            |--------------------------------------------------------------------------
            */

            $table->timestamp('submitted_at')
                ->nullable();


            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | One Ballot Per Voting Session
            |--------------------------------------------------------------------------
            */

            $table->unique('voting_session_id');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ballots');
    }
};