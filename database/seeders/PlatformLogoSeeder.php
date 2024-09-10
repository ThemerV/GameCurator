<?php

namespace Database\Seeders;

use App\Models\PlatformLogo;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class PlatformLogoSeeder extends Seeder
{
    public function run(): void
    {
        PlatformLogo::truncate();

        $platformLogos = Items::fromFile("scripts/data/platform_logos_data.json");

        foreach ($platformLogos as $key => $value) {
            $exists = PlatformLogo::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            PlatformLogo::create([
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
