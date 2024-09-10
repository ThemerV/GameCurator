<?php

namespace Database\Seeders;

use App\Models\PlatformFamily;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class PlatformFamilySeeder extends Seeder
{
    public function run(): void
    {
        PlatformFamily::truncate();

        $platformFamilies = Items::fromFile("scripts/data/platform_families_data.json");

        foreach ($platformFamilies as $key => $value) {
            $exists = PlatformFamily::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            PlatformFamily::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
            ]);
        }
    }
}
