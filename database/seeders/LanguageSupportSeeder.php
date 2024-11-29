<?php

namespace Database\Seeders;

use App\Models\LanguageSupport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonMachine\Items;

class LanguageSupportSeeder extends Seeder
{
    public function run(): void
    {
        LanguageSupport::truncate();

        $languageSupports = Items::fromFile("scripts/data/language_supports_data.json");

        foreach ($languageSupports as $key => $value) {
            $exists = LanguageSupport::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            LanguageSupport::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'game_id' => $value->game ?? null,
                'language_id' => $value->language ?? null,
                'language_support_type_id' => $value->language_support_type ?? null,
            ]);

        };
    }
}
