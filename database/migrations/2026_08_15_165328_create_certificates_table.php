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
        Schema::create('certificates', function (Blueprint $table) {

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
            | Winner
            |--------------------------------------------------------------------------
            */

            $table->foreignId('candidate_id')
                ->constrained('candidates')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Position Won
            |--------------------------------------------------------------------------
            */

            $table->foreignId('election_position_id')
                ->constrained('election_positions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Certificate Information
            |--------------------------------------------------------------------------
            */

            $table->string('certificate_number')
                ->unique();

            $table->string('verification_code')
                ->unique();


            /*
            |--------------------------------------------------------------------------
            | Issuance
            |--------------------------------------------------------------------------
            */

            $table->timestamp('issued_at')
                ->nullable();

            $table->foreignId('issued_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Certificate Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'issued',
                'revoked',
            ])->default('issued');


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
                'candidate_id',
            ]);

            $table->index([
                'election_id',
                'election_position_id',
            ]);

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};