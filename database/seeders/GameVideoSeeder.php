<?php

namespace Database\Seeders;

use App\Models\GameVideo;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class GameVideoSeeder extends Seeder
{
    public function run(): void
    {
        GameVideo::truncate();

        $gameVideos = Items::fromFile("scripts/data/game_videos_data.json");

        foreach ($gameVideos as $key => $value) {
            $exists = GameVideo::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            GameVideo::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'game_id' => $value->game ?? null,
                'name' => $value->name ?? null,
                'video_id' => $value->video_id ?? null,
            ]);
        }
    }
}
