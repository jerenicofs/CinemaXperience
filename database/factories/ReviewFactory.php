<?php

namespace Database\Factories;

use App\Models\Media;
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
    public function definition(): array
    {
        return [
           'user_id' => User::all()->random()->id,
            'media_id' => Media::all()->random()->id,
            'comment' => $this->faker->paragraph,
            'rating' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
