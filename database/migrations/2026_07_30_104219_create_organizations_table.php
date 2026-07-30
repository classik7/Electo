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
        Schema::create('organizations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('owner_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('logo')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('website')->nullable();

            $table->string('country')->nullable();

            $table->string('state')->nullable();

            $table->string('city')->nullable();

            $table->text('address')->nullable();

            $table->longText('description')->nullable();

            $table->enum('verification_status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');

            $table->enum('subscription_plan', [
                'free',
                'starter',
                'professional',
                'enterprise'
            ])->default('free');

            $table->enum('status', [
                'active',
                'inactive',
                'suspended'
            ])->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};