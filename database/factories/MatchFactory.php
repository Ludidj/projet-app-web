<?php

namespace Database\Factories;

use App\Models\Match1;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Match1>
 */
class MatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dateMatch' => fake()->date(),
            'lieu' => fake()->city(),
            'score' => fake()->numberBetween(0, 10),
            //
        ];
    }
}
