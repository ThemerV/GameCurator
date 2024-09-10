<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        Region::truncate();

        $regions = Items::fromFile("scripts/data/regions_data.json");

        foreach ($regions as $key => $value) {
            $exists = Region::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Region::create([
                'igdb_id' => $value->id,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'identifier' => $value->identifier ?? null,
                'name' => $value->name ?? null,
            ]);
        }
    }
}
