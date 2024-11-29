<?php

namespace Database\Seeders;

use App\Models\MultiplayerMode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonMachine\Items;

class MultiplayerModeSeeder extends Seeder
{
    public function run(): void
    {
        MultiplayerMode::truncate();

        $multiplayerModes = Items::fromFile("scripts/data/multiplayer_modes_data.json");

        foreach ($multiplayerModes as $key => $value) {
            $exists = MultiplayerMode::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            MultiplayerMode::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'dropin' => $value->dropin ?? null,
                'game_id' => $value->game ?? null,
                'lancoop' => $value->lancoop ?? null,
                'offlinecoop' => $value->offlinecoop ?? null,
                'offlinecoopmax' => $value->offlinecoopmax ?? null,
                'offlinemax' => $value->offlinemax ?? null,
                'onlinecoop' => $value->onlinecoop ?? null,
                'onlinecoopmax' => $value->onlinecoopmax ?? null,
                'onlinemax' => $value->onlinemax ?? null,
                'platform_id' => $value->platform ?? null,
                'splitscreen' => $value->splitscreen ?? null,
                'splitscreenonline' => $value->splitscreenonline ?? null,
            ]);
        }
    }
}
