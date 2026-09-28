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
        Schema::table('user_settings', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Election Preferences
            |--------------------------------------------------------------------------
            */

            $table->boolean('election_reminders')
                ->default(true)
                ->after('election_notifications');

            $table->boolean('election_registration_updates')
                ->default(true)
                ->after('election_reminders');

            $table->boolean('voting_confirmation')
                ->default(true)
                ->after('election_registration_updates');

            $table->boolean('election_closing_reminders')
                ->default(true)
                ->after('voting_confirmation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {

            $table->dropColumn([
                'election_reminders',
                'election_registration_updates',
                'voting_confirmation',
                'election_closing_reminders',
            ]);

        });
    }
};