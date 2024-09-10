<?php

namespace Database\Seeders;

use App\Models\ReleaseDate;
use Illuminate\Database\Seeder;
use JsonMachine\Items;

class ReleaseDateSeeder extends Seeder
{
    public function run(): void
    {
        ReleaseDate::truncate();

        $releaseDates = Items::fromFile("scripts/data/release_dates_data.json");

        foreach ($releaseDates as $key => $value) {
            $exists = ReleaseDate::where('igdb_id', $value->id)->exists();

            if ($exists) {
                continue;
            }

            ReleaseDate::create([
                'igdb_id' => $value->id,
                'checksum' => $value->checksum ?? null,
                'date' => $value->date ?? null,
                'game' => $value->game ?? null,
                'region' => $value->region ?? null,
                'human' => $value->human ?? null,
            ]);
        }
    }
}
