<?php

namespace Database\Seeders;

use App\Models\Screenshot;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class ScreenshotSeeder extends Seeder
{
    public function run(): void
    {
        Screenshot::truncate();

        $screenshots = Items::fromFile("scripts/data/screenshots_data.json");

        foreach ($screenshots as $key => $value) {
            $exists = Screenshot::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Screenshot::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
