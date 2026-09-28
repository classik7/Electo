<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voting_sessions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Core Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('election_id')
                ->constrained('elections')
                ->cascadeOnDelete();

            $table->foreignId('voter_id')
                ->constrained('voters')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Public Voting Station
            |--------------------------------------------------------------------------
            |
            | Nullable because a voter using their personal device
            | does not belong to a public voting station.
            |
            */

            $table->foreignId('voting_station_id')
                ->nullable()
                ->constrained('voting_stations')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Voting Method
            |--------------------------------------------------------------------------
            */

            $table->enum('voting_method', [
                'personal_device',
                'public_device',
                'assisted',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Session Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'authenticated',
                'ballot_open',
                'submitted',
                'completed',
                'expired',
                'cancelled',
            ])->default('pending');


            /*
            |--------------------------------------------------------------------------
            | Session Security
            |--------------------------------------------------------------------------
            */

            $table->string('session_token')
                ->unique();

            $table->timestamp('authenticated_at')
                ->nullable();

            $table->timestamp('ballot_opened_at')
                ->nullable();

            $table->timestamp('submitted_at')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();

            $table->timestamp('expires_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Device / Session Information
            |--------------------------------------------------------------------------
            |
            | We store limited technical information for security auditing.
            | We do NOT store fingerprints, Face ID data, or biometric templates.
            |
            */

            $table->string('device_identifier')
                ->nullable();

            $table->string('ip_address')
                ->nullable();

            $table->text('user_agent')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Helpful Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'election_id',
                'voter_id',
            ]);

            $table->index([
                'voting_station_id',
                'status',
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_sessions');
    }
};