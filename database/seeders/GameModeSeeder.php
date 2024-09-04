<?php

namespace Database\Seeders;

use App\Models\GameMode;
use Illuminate\Database\Seeder;

class GameModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game_modes = [
            ['igdb_id' => '1', 'name' => 'Single Player', 'slug' => 'single-player'],
            ['igdb_id' => '2', 'name' => 'Multiplayer', 'slug' => 'multiplayer'],
            ['igdb_id' => '3', 'name' => 'Co-operative', 'slug' => 'co-operative'],
            ['igdb_id' => '4', 'name' => 'Split screen', 'slug' => 'split-screen'],
            ['igdb_id' => '5', 'name' => 'Massively Multiplayer Online (MMO)', 'slug' => 'massively-multiplayer-online-mmo'],
            ['igdb_id' => '6', 'name' => 'Battle Royale', 'slug' => 'battle-royale'],
        ];

        foreach ($game_modes as $game_mode) {
            GameMode::create($game_mode);
        }
    }
}
