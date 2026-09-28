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
        Schema::create('two_factor_authentications', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | TOTP Secret
            |--------------------------------------------------------------------------
            |
            | This is the secret used by the authenticator application.
            |
            */
            $table->text('secret');

            /*
            |--------------------------------------------------------------------------
            | 2FA Status
            |--------------------------------------------------------------------------
            */
            $table->boolean('enabled')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Confirmation
            |--------------------------------------------------------------------------
            |
            | This becomes populated only after the user successfully
            | verifies the first authenticator code.
            |
            */
            $table->timestamp('confirmed_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Recovery Codes
            |--------------------------------------------------------------------------
            |
            | These will eventually contain securely stored recovery codes.
            |
            */
            $table->text('recovery_codes')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('two_factor_authentications');
    }
};