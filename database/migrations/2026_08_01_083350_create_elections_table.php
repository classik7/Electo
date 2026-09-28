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
        Schema::create('elections', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('election_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */

            $table->string('logo')->nullable();

            $table->string('banner')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Schedule
            |--------------------------------------------------------------------------
            */

            $table->dateTime('starts_at');

            $table->dateTime('ends_at');

            /*
            |--------------------------------------------------------------------------
            | Publication
            |--------------------------------------------------------------------------
            */

            $table->timestamp('published_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Election Settings
            |--------------------------------------------------------------------------
            */

            $table->enum('visibility', [
                'public',
                'private',
            ])->default('private');

            $table->enum('status', [
                'draft',
                'published',
                'cancelled',
            ])->default('draft');

            /*
            |--------------------------------------------------------------------------
            | Voting Options
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_multiple_votes')->default(false);

            $table->boolean('show_live_results')->default(false);

            $table->boolean('require_voter_verification')->default(true);

            $table->boolean('allow_result_download')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Soft Deletes
            |--------------------------------------------------------------------------
            */

            $table->softDeletes();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elections');
    }
};