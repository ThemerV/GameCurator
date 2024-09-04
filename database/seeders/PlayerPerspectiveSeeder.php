<?php

namespace Database\Seeders;

use App\Models\PlayerPerspective;
use Illuminate\Database\Seeder;

class PlayerPerspectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $player_perspectives = [
            ['igdb_id' => '1', 'name' => 'First person', 'slug' => 'first-person'],
            ['igdb_id' => '2', 'name' => 'Third person', 'slug' => 'third-person'],
            ['igdb_id' => '3', 'name' => 'Bird view / Isometric', 'slug' => 'bird-view-slash-isometric'],
            ['igdb_id' => '4', 'name' => 'Side view', 'slug' => 'Side view'],
            ['igdb_id' => '5', 'name' => 'Text', 'slug' => 'text'],
            ['igdb_id' => '6', 'name' => 'Auditory', 'slug' => 'auditory'],
            ['igdb_id' => '7', 'name' => 'Virtual Reality', 'slug' => 'virtual-reality'],
        ];

        foreach ($player_perspectives as $player_perspective) {
            PlayerPerspective::create($player_perspective);
        }
    }
}
