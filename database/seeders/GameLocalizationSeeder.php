<?php

namespace Database\Seeders;

use App\Models\GameLocalization;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class GameLocalizationSeeder extends Seeder
{
    public function run(): void
    {
        GameLocalization::truncate();

        $gameLocalizations = Items::fromFile("scripts/data/game_localizations_data.json");

        foreach ($gameLocalizations as $key => $value) {
            $exists = GameLocalization::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            GameLocalization::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'cover' => $value->cover ?? null,
                'game' => $value->game ?? null,
                'name' => $value->name ?? null,
                'region' => $value->region ?? null,
            ]);
        }
    }
}
