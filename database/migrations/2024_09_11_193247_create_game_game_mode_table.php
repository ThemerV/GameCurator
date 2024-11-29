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
        Schema::create('game_game_mode', function (Blueprint $table) {
            $table->integer('game_igdb_id');
            $table->integer('game_mode_igdb_id');
            $table->foreign('game_igdb_id')->references('igdb_id')->on('games')->onDelete('cascade');
            $table->foreign('game_mode_igdb_id')->references('igdb_id')->on('game_modes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_game_mode');
    }
};
