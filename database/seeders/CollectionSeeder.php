<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        Collection::truncate();

        $collections = Items::fromFile("scripts/data/collections_data.json");

        foreach ($collections as $key => $value) {
            $exists = Collection::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Collection::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'games' => $value->games ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
