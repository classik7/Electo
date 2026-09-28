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
        Schema::table('election_voters', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Accreditation Tracking
            |--------------------------------------------------------------------------
            */

            $table->foreignId('accredited_by')
                ->nullable()
                ->after('accredited_at')
                ->constrained('users')
                ->nullOnDelete();

            $table->string('accreditation_reference', 100)
                ->nullable()
                ->unique()
                ->after('accreditation_method');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('election_voters', function (Blueprint $table) {

            $table->dropForeign([
                'accredited_by',
            ]);

            $table->dropColumn([
                'accredited_by',
                'accreditation_reference',
            ]);

        });
    }
};