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

            $table->foreignId('election_id')
                ->after('id')
                ->constrained('elections')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('election_positions', function (Blueprint $table) {

            $table->dropForeign(['election_id']);

            $table->dropColumn('election_id');

        });
    }
};