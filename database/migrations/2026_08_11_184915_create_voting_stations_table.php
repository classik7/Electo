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
        Schema::create('voting_stations', function (Blueprint $table) {

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
            | Station Identity
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('code');

            $table->string('location')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Station Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',
                'inactive',
                'maintenance',
            ])->default('active');


            /*
            |--------------------------------------------------------------------------
            | Station Access
            |--------------------------------------------------------------------------
            |
            | This will later help us distinguish official public
            | voting devices from ordinary devices.
            |
            */

            $table->boolean('is_public')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Station Codes
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'election_id',
                'code',
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voting_stations');
    }
};