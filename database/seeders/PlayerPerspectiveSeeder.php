<?php

namespace Database\Seeders;

use App\Models\PlayerPerspective;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class PlayerPerspectiveSeeder extends Seeder
{
    public function run(): void
    {
        PlayerPerspective::truncate();

        $playerPerspectives = Items::fromFile("scripts/data/player_perspectives_data.json");

        foreach ($playerPerspectives as $key => $value) {
            $exists = PlayerPerspective::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            PlayerPerspective::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
            ]);
        }
    }
}
