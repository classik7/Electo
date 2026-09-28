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
        Schema::create('election_voters', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
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
            | Eligibility
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_eligible')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Accreditation
            |--------------------------------------------------------------------------
            */

            $table->enum('accreditation_status', [
                'pending',
                'accredited',
                'rejected',
            ])->default('pending');

            $table->timestamp('accredited_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Accreditation Method
            |--------------------------------------------------------------------------
            */

            $table->enum('accreditation_method', [
                'personal_device',
                'public_device',
                'assisted',
            ])->nullable();


            /*
            |--------------------------------------------------------------------------
            | Voting Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('has_voted')
                ->default(false);

            $table->timestamp('voted_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Election Registration
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'election_id',
                'voter_id',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_voters');
    }
};