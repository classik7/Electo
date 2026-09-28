<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('election_categories', function (Blueprint $table) {

            $table->id();

            $table->string('name')->unique();

            $table->string('slug')->unique();

            $table->string('icon')->nullable();

            $table->string('color')->default('blue');

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('election_categories');
    }
};