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
        Schema::create('covers', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->boolean('animated')->nullable();
            $table->integer('game')->nullable();
            $table->integer('game_localization')->nullable();
            $table->integer('height')->nullable();
            $table->string('image_id')->nullable();
            $table->string('url')->nullable();
            $table->integer('width')->nullable();
            $table->timestamps();

            $table->foreign('game')->references('igdb_id')->on('games');
            $table->foreign('game_localization')->references('igdb_id')->on('game_localizations');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
