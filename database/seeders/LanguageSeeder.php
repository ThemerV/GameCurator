<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::truncate();

        $languages = Items::fromFile("scripts/data/languages_data.json");

        foreach ($languages as $key => $value) {
            $exists = Language::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Language::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'locale' => $value->locale ?? null,
                'name' => $value->name ?? null,
                'native_name' => $value->native_name ?? null,
            ]);
        }
    }
}
