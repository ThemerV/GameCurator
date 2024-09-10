<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        Genre::truncate();

        $genres = Items::fromFile("scripts/data/genres_data.json");

        foreach ($genres as $key => $value) {
            $exists = Genre::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Genre::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
