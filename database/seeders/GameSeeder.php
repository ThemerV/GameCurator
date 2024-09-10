<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use JsonMachine\Items;
class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::truncate();

        $games = Items::fromFile("scripts/data/games_data.json");

        foreach ($games as $key => $value) {
            $exists = Game::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Game::create([
                'igdb_id' => $value->id,
                'artworks' => $value->artworks ?? null,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'collections' => $value->collections ?? null,
                'cover' => $value->cover ?? null,
                'dlcs' => $value->dlcs ?? null,
                'expansions' => $value->expansions ?? null,
                'first_release_date' => $value->first_release_date ?? null,
                'franchises' => $value->franchises ?? null,
                'game_localizations' => $value->game_localizations ?? null,
                'game_modes' => $value->game_modes ?? null,
                'genres' => $value->genres ?? null,
                'involved_companies' => $value->involved_companies ?? null,
                'language_supports' => $value->language_supports ?? null,
                'multiplayer_modes' => $value->multiplayer_modes ?? null,
                'name' => $value->name ?? null,
                'parent_game' => $value->parent_game ?? null,
                'platforms' => $value->platforms ?? null,
                'player_perspectives' => $value->player_perspectives ?? null,
                'release_dates' => $value->release_dates ?? null,
                'screenshots' => $value->screenshots ?? null,
                'similar_games' => $value->similar_games ?? null,
                'slug' => $value->slug ?? null,
                'storyline' => $value->storyline ?? null,
                'summary' => $value->summary ?? null,
                'themes' => $value->themes ?? null,
                'url' => $value->url ?? null,
                'videos' => $value->videos ?? null,
                'websites' => $value->websites ?? null
            ]);
        }
    }
}
