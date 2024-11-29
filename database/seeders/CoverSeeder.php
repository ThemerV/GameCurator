<?php

namespace Database\Seeders;

use App\Models\Cover;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CoverSeeder extends Seeder
{
    public function run(): void
    {
        Cover::truncate();

        $covers = Items::fromFile("scripts/data/covers_data.json");

        foreach ($covers as $key => $value) {
            $exists = Cover::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Cover::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
