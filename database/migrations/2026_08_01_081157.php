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
        Schema::create('election_types', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationship
            |--------------------------------------------------------------------------
            */

            $table->foreignId('category_id')
                ->constrained('election_categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('icon')->nullable();

            $table->string('color')->default('blue');

            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Election Metadata
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('setup_minutes')->default(2);

            $table->enum('difficulty', [
                'Easy',
                'Moderate',
                'Advanced',
            ])->default('Easy');

            $table->json('default_positions')->nullable();

            $table->boolean('is_featured')->default(false);

            /*
            |--------------------------------------------------------------------------
            | System
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')->default(true);

            $table->boolean('approved')->default(true);

            $table->unsignedInteger('usage_count')->default(0);

            $table->unsignedInteger('sort_order')->default(0);

            $table->softDeletes();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('status');
            $table->index('approved');
            $table->index('usage_count');
            $table->index('is_featured');
            $table->index('difficulty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_types');
    }
};