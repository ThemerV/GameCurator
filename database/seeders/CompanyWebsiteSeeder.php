<?php

namespace Database\Seeders;

use App\Models\CompanyWebsite;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CompanyWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        CompanyWebsite::truncate();

        $companyWebsites = Items::fromFile("scripts/data/company_websites_data.json");

        foreach ($companyWebsites as $key => $value) {
            $exists = CompanyWebsite::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            CompanyWebsite::create([
                'igdb_id' => $value->id,
                'category' => $value->category ?? null,
                'checksum' => $value->checksum ?? null,
                'trusted' => $value->trusted ?? null,
                'url' => $value->url ?? null,
            ]);
        }
    }
}
