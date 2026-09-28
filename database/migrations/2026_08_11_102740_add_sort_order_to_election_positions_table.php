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

            $table->string('name')
                ->after('id');

            $table->text('description')
                ->nullable()
                ->after('name');

            $table->unsignedInteger('sort_order')
                ->default(0)
                ->after('description');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('election_positions', function (Blueprint $table) {

            $table->dropColumn([
                'name',
                'description',
                'sort_order',
            ]);

        });
    }
};