<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['igdb_id' => '2', 'name' => 'Point-and-click', 'slug' => 'point-and-click'],
            ['igdb_id' => '4', 'name' => 'Fighting', 'slug' => 'fighting'],
            ['igdb_id' => '5', 'name' => 'Shooter', 'slug' => 'shooter'],
            ['igdb_id' => '7', 'name' => 'Music', 'slug' => 'music'],
            ['igdb_id' => '8', 'name' => 'Platform', 'slug' => 'platform'],
            ['igdb_id' => '9', 'name' => 'Puzzle', 'slug' => 'puzzle'],
            ['igdb_id' => '10', 'name' => 'Racing', 'slug' => 'racing'],
            ['igdb_id' => '11', 'name' => 'Real Time Strategy (RTS)', 'slug' => 'real-time-strategy-rts'],
            ['igdb_id' => '12', 'name' => 'Role-playing (RPG)', 'slug' => 'role-playing-rpg'],
            ['igdb_id' => '13', 'name' => 'Simulator', 'slug' => 'simulator']
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
