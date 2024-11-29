<?php

namespace Database\Seeders;

use App\Models\LanguageSupportType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonMachine\Items;

class LanguageSupportTypeSeeder extends Seeder
{
    public function run(): void
    {
        LanguageSupportType::truncate();

        $languageSupportTypes = Items::fromFile("scripts/data/language_support_types_data.json");

        foreach ($languageSupportTypes as $key => $value) {
            $exists = LanguageSupportType::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            LanguageSupportType::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'name' => $value->name ?? null,
            ]);
        }
    }
}
