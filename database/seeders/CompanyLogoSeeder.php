<?php

namespace Database\Seeders;

use App\Models\CompanyLogo;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CompanyLogoSeeder extends Seeder
{
    public function run(): void
    {
        CompanyLogo::truncate();

        $companyLogos = Items::fromFile("scripts/data/company_logos_data.json");

        foreach ($companyLogos as $key => $value) {
            $exists = CompanyLogo::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            CompanyLogo::create([
                'igdb_id' => $value->id,
                'animated' => $value->animated ?? null,
                'checksum' => $value->checksum ?? null,
                'height' => $value->height ?? null,
                'image_id' => $value->image_id ?? null,
                'url' => $value->url ?? null,
                'width' => $value->width ?? null,
            ]);
        }
    }
}
