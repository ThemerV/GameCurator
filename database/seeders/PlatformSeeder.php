<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        Platform::truncate();

        $platforms = Items::fromFile("scripts/data/platforms_data.json");

        foreach ($platforms as $key => $value) {
            $exists = Platform::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Platform::create([
                'igdb_id' => $value->id,
                'abbreviation' => $value->abbreviation ?? null,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'generation' => $value->generation ?? null,
                'name' => $value->name ?? null,
                'platform_family' => $value->platform_family ?? null,
                'platform_logo' => $value->platform_logo ?? null,
                'slug' => $value->slug ?? null,
                'summary' => $value->summary ?? null,
                'url' => $value->url ?? null,
                'websites' => $value->websites ?? null,
            ]);
        }
    }
}
