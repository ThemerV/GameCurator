<?php

namespace Database\Seeders;

use App\Models\Franchise;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class FranchiseSeeder extends Seeder
{
    public function run(): void
    {
        Franchise::truncate();

        $franchises = Items::fromFile("scripts/data/franchises_data.json");

        foreach ($franchises as $key => $value) {
            $exists = Franchise::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Franchise::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'games' => $value->games ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
