<?php

namespace Database\Factories;

use App\Models\Entrainement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Entrainement>
 */
class EntrainementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

         'date' => fake()->now(),
            //
        ];
    }
}
