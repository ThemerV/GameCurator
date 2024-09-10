<?php

namespace Database\Seeders;

use App\Models\GameMode;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class GameModeSeeder extends Seeder
{
    public function run(): void
    {
        GameMode::truncate();

        $gameModes = Items::fromFile("scripts/data/game_modes_data.json");

        foreach ($gameModes as $key => $value) {
            $exists = GameMode::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            GameMode::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
