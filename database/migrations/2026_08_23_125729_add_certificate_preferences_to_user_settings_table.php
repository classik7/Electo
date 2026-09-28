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

            $table->boolean('certificate_issued_notifications')
                ->default(true)
                ->after('certificate_notifications');

            $table->boolean('certificate_status_updates')
                ->default(true)
                ->after('certificate_issued_notifications');

            $table->boolean('certificate_verification_updates')
                ->default(true)
                ->after('certificate_status_updates');

            $table->boolean('certificate_availability_updates')
                ->default(true)
                ->after('certificate_verification_updates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {

            $table->dropColumn([
                'certificate_issued_notifications',
                'certificate_status_updates',
                'certificate_verification_updates',
                'certificate_availability_updates',
            ]);
        });
    }
};