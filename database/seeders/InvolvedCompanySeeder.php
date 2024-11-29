<?php

namespace Database\Seeders;

use App\Models\InvolvedCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonMachine\Items;

class InvolvedCompanySeeder extends Seeder
{
    public function run(): void
    {
        InvolvedCompany::truncate();

        $involvedCompanies = Items::fromFile("scripts/data/involved_companies_data.json");

        foreach ($involvedCompanies as $key => $value) {
            $exists = InvolvedCompany::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            InvolvedCompany::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'company_id' => $value->company ?? null,
                'developer' => $value->developer ?? null,
                'game_id' => $value->game ?? null,
                'porting' => $value->porting ?? null,
                'publisher' => $value->publisher ?? null,
                'supporting' => $value->supporting ?? null,
            ]);
        }

    }
}
