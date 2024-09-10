<?php

namespace Database\Seeders;

use App\Models\PlatformWebsite;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class PlatformWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        PlatformWebsite::truncate();

        $platformWebsites = Items::fromFile("scripts/data/platform_websites_data.json");

        foreach ($platformWebsites as $key => $value) {
            $exists = PlatformWebsite::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            PlatformWebsite::create([
                'igdb_id' => $value->id,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
