<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class WebsiteSeeder extends Seeder
{
    public function run(): void
    {
        Website::truncate();

        $websites = Items::fromFile("scripts/data/websites_data.json");

        foreach ($websites as $key => $value) {
            $exists = Website::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Website::create([
                'igdb_id' => $value->id,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'trusted' => $value->trusted ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
