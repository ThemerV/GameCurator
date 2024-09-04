<?php

namespace Database\Seeders;

use App\Models\Artwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artwork::truncate();

        $json = File::get("scripts/data/artworks_data.json");
        $artworks = json_decode($json);

        foreach ($artworks as $key => $value) {
            Artwork::create([
                'animated' => $value->animated,
                'game_idgb_id' => $value->game,
                'height' => $value->height,
                'image_id' => $value->image_id,
                'url' => $value->url,
                'width' => $value->width
            ]);
        }
    }
}
