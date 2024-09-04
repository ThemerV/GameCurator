<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collection::truncate();

        $collections = Items::fromFile("scripts/data/collections_data.json");

        foreach ($collections as $key => $value) {
            $exists = Collection::where('igdb_id', $value->id)->exists();

            if ($exists) {
                print_r($exists);
                continue;
            }

            Collection::create([
                'igdb_id' => $value->id,
                'artworks' => $value->artworks ?? null,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'collections' => $value->collections ?? null,
                'cover' => $value->cover ?? null,
                'dlcs' => $value->dlcs ?? null,
                'expansions' => $value->expansions ?? null,
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
