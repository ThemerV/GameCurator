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
        Schema::create('release_dates', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('category')->nullable();
            $table->integer('date')->nullable();
            $table->integer('game_id')->nullable();
            $table->string('human')->nullable();
            $table->integer('m')->nullable();
            $table->integer('platform_id')->nullable();
            $table->integer('region')->nullable();
            $table->integer('y')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_dates');
    }
};
