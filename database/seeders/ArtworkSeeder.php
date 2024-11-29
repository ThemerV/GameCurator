<?php

namespace Database\Seeders;

use App\Models\Artwork;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        Artwork::truncate();

        $artworks = Items::fromFile("scripts/data/artworks_data.json");

        foreach ($artworks as $key => $value) {
            $exists = Artwork::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Artwork::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'game_id' => $value->game ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
