<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::truncate();

        $companies = Items::fromFile("scripts/data/companies_data.json");

        foreach ($companies as $key => $value) {
            $exists = Company::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            Company::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'country' => $value->country ?? null,
                'description' => $value->description ?? null,
                'developed' => $value->developed ?? null,
                'logo' => $value->logo ?? null,
                'name' => $value->name ?? null,
                'parent' => $value->parent ?? null,
                'published' => $value->published ?? null,
                'slug' => $value->slug ?? null,
                'url' => $value->url ?? null,
                'websites' => $value->websites ?? null,
            ]);
        }
    }
}
