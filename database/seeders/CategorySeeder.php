<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'main_game', 'value' => 0],
            ['name' => 'dlc_addon', 'value' => 1],
            ['name' => 'expansion', 'value' => 2],
            ['name' => 'bundle', 'value' => 3],
            ['name' => 'standalone_expansion', 'value' => 4],
            ['name' => 'mod', 'value' => 5],
            ['name' => 'episode', 'value' => 6],
            ['name' => 'season', 'value' => 7],
            ['name' => 'remake', 'value' => 8],
            ['name' => 'remaster', 'value' => 9],
            ['name' => 'expanded_game', 'value' => 10],
            ['name' => 'port', 'value' => 11],
            ['name' => 'fork', 'value' => 12],
            ['name' => 'pack', 'value' => 13],
            ['name' => 'update', 'value' => 14],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
