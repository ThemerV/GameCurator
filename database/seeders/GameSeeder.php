<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

            if (isset($value->first_release_date) && $value->first_release_date < 0) {
                $value->first_release_date *= -1;
                continue;
            }

            Game::create([
                'igdb_id' => $value->id,
                'artworks_array' => $value->artworks ?? null,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'collections_array' => $value->collections ?? null,
                'cover_id' => $value->cover ?? null,
                'dlcs_array' => $value->dlcs ?? null,
                'expansions_array' => $value->expansions ?? null,
                'first_release_date' => $value->first_release_date ?? null,
                'franchises_array' => $value->franchises ?? null,
                'game_modes_array' => $value->game_modes ?? null,
                'genres_array' => $value->genres ?? null,
                'involved_companies_array' => $value->involved_companies ?? null,
                'language_supports_array' => $value->language_supports ?? null,
                'multiplayer_modes_array' => $value->multiplayer_modes ?? null,
                'name' => $value->name ?? null,
                'parent_game_id' => $value->parent_game ?? null,
                'platforms_array' => $value->platforms ?? null,
                'player_perspectives_array' => $value->player_perspectives ?? null,
                'release_dates_array' => $value->release_dates ?? null,
                'screenshots_array' => $value->screenshots ?? null,
                'similar_games_array' => $value->similar_games ?? null,
                'slug' => $value->slug ?? null,
                'storyline' => $value->storyline ?? null,
                'summary' => $value->summary ?? null,
                'themes_array' => $value->themes ?? null,
                'videos_array' => $value->videos ?? null,
                'websites_array' => $value->websites ?? null
            ]);
        }
    }
}
