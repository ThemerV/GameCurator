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
                'animated' => $value->animated ?? null,
                'checksum' => $value->checksum ?? null,
                'height' => $value->height ?? null,
                'image_id' => $value->image_id ?? null,
                'url' => $value->url ?? null,
                'width' => $value->width ?? null,
            ]);
        }
    }
}
