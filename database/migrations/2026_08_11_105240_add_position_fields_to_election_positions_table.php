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
        Schema::table('election_positions', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Election Relationship
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('election_positions', 'election_id')) {

                $table->foreignId('election_id')
                    ->after('id')
                    ->constrained('elections')
                    ->cascadeOnDelete();

            }

            /*
            |--------------------------------------------------------------------------
            | Position Information
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('election_positions', 'name')) {

                $table->string('name')
                    ->after('election_id');

            }

            if (!Schema::hasColumn('election_positions', 'description')) {

                $table->text('description')
                    ->nullable()
                    ->after('name');

            }

            /*
            |--------------------------------------------------------------------------
            | Position Ordering
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('election_positions', 'sort_order')) {

                $table->unsignedInteger('sort_order')
                    ->default(0)
                    ->after('description');

            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('election_positions', function (Blueprint $table) {

            if (Schema::hasColumn('election_positions', 'election_id')) {
                $table->dropForeign(['election_id']);
                $table->dropColumn('election_id');
            }

            if (Schema::hasColumn('election_positions', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('election_positions', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('election_positions', 'sort_order')) {
                $table->dropColumn('sort_order');
            }

        });
    }
};