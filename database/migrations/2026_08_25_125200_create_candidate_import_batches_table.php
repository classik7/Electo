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
        Schema::create('candidate_import_batches', function (Blueprint $table) {

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
            | Administrator
            |--------------------------------------------------------------------------
            */

            $table->foreignId('imported_by')
                ->constrained('users')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Import Information
            |--------------------------------------------------------------------------
            */

            $table->string('file_name');

            $table->string('file_path')->nullable();

            $table->string('file_type', 20)->nullable();


            /*
            |--------------------------------------------------------------------------
            | Import Statistics
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('total_rows')
                ->default(0);

            $table->unsignedInteger('successful_rows')
                ->default(0);

            $table->unsignedInteger('failed_rows')
                ->default(0);

            $table->unsignedInteger('duplicate_rows')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('pending');


            /*
            |--------------------------------------------------------------------------
            | Error Report
            |--------------------------------------------------------------------------
            */

            $table->json('errors')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Completion
            |--------------------------------------------------------------------------
            */

            $table->timestamp('completed_at')
                ->nullable();


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'candidate_import_batches'
        );
    }
};