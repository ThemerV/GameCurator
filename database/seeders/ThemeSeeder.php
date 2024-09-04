<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            ['igdb_id' => '31', 'name' => 'Drama', 'slug' => 'Drama'],
            ['igdb_id' => '32', 'name' => 'Non-fiction', 'slug' => 'non-fiction'],
            ['igdb_id' => '33', 'name' => 'Sandbox', 'slug' => 'sandbox'],
            ['igdb_id' => '34', 'name' => 'Educational', 'slug' => 'educational'],
            ['igdb_id' => '35', 'name' => 'Kids', 'slug' => 'kids'],
            ['igdb_id' => '38', 'name' => 'Open world', 'slug' => 'open-world'],
            ['igdb_id' => '39', 'name' => 'Warfare', 'slug' => 'warfare'],
            ['igdb_id' => '40', 'name' => 'Party', 'slug' => 'party'],
            ['igdb_id' => '41', 'name' => '4X (explore, expand, exploit, and exterminate)', 'slug' => '4x-explore-expand-exploit-and-exterminate'],
            ['igdb_id' => '42', 'name' => 'Erotic', 'slug' => 'erotic'],
            ['igdb_id' => '', 'name' => '', 'slug' => ''],
        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }
    }
}
