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
            $table->json('artworks_array')->nullable();
            $table->integer('category')->nullable();
            $table->uuid('checksum')->nullable();
            $table->json('collections_array')->nullable();
            $table->integer('cover_id')->nullable();
            $table->json('dlcs_array')->nullable();
            $table->json('expansions_array')->nullable();
            $table->timestamp('first_release_date')->nullable();
            $table->json('franchises_array')->nullable();
            $table->json('game_modes_array')->nullable();
            $table->json('genres_array')->nullable();
            $table->json('involved_companies_array')->nullable();
            $table->json('language_supports_array')->nullable();
            $table->json('multiplayer_modes_array')->nullable();
            $table->string('name')->nullable();
            $table->integer('parent_game_id')->nullable();
            $table->json('platforms_array')->nullable();
            $table->json('player_perspectives_array')->nullable();
            $table->json('release_dates_array')->nullable();
            $table->json('screenshots_array')->nullable();
            $table->json('similar_games_array')->nullable();
            $table->string('slug')->unique();
            $table->json('standalone_expansions_array')->nullable();
            $table->integer('status')->nullable();
            $table->text('storyline')->nullable();
            $table->text('summary')->nullable();
            $table->json('themes_array')->nullable();
            $table->json('videos_array')->nullable();
            $table->json('websites_array')->nullable();
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
