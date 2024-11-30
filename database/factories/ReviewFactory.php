<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'game_igdb_id' => Game::inRandomOrder()->first()->igdb_id,
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph,
        ];
    }
}
