<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        Theme::truncate();

        $themes = Items::fromFile("scripts/data/themes_data.json");

        foreach ($themes as $key => $value) {
            $exists = Theme::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Theme::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
                'slug' => $value->slug ?? null,
            ]);
        }
    }
}
