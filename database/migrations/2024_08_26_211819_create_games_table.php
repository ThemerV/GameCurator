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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->json('artworks')->nullable();
            $table->string('category')->nullable();
            $table->uuid('checksum')->nullable();
            $table->json('collections')->nullable();
            $table->integer('cover')->nullable();
            $table->json('dlcs')->nullable();
            $table->json('expansions')->nullable();
            $table->json('franchises')->nullable();
            $table->json('game_localizations')->nullable();
            $table->json('game_modes')->nullable();
            $table->json('genres')->nullable();
            $table->json('involved_companies')->nullable();
            $table->json('language_supports')->nullable();
            $table->json('multiplayer_modes')->nullable();
            $table->string('name');
            $table->integer('parent_game')->nullable();
            $table->json('platforms')->nullable();
            $table->json('player_perspectives')->nullable();
            $table->json('release_dates')->nullable();
            $table->json('screenshots')->nullable();
            $table->json('similar_games')->nullable();
            $table->string('slug')->unique();
            $table->json('standalone_expansions')->nullable();
            $table->text('storyline')->nullable();
            $table->text('summary')->nullable();
            $table->json('themes')->nullable();
            $table->string('url')->nullable();
            $table->json('videos')->nullable();
            $table->json('websites')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
