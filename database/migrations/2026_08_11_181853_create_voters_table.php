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
        Schema::create('voters', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Voter Identity
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('voter_id')
                ->unique();

            $table->string('email')
                ->nullable();

            $table->string('phone')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Profile
            |--------------------------------------------------------------------------
            */

            $table->string('photo')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Account / Verification
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',
                'inactive',
                'suspended',
            ])->default('active');

            $table->timestamp('verified_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};