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
        Schema::create('genre_game', function (Blueprint $table) {
            $table->integer('game_igdb_id');
            $table->integer('genre_igdb_id');
            $table->foreign('game_igdb_id')->references('igdb_id')->on('games')->onDelete('cascade');
            $table->foreign('genre_igdb_id')->references('igdb_id')->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_game');
    }
};
