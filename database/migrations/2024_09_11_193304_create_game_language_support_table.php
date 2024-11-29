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
        Schema::create('game_language_support', function (Blueprint $table) {
            $table->integer('game_igdb_id');
            $table->integer('language_support_igdb_id');
            $table->foreign('game_igdb_id')->references('igdb_id')->on('games');
            $table->foreign('language_support_igdb_id')->references('igdb_id')->on('language_supports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_language_support');
    }
};
