<?php

namespace Database\Factories;

use App\Models\Equipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Equipe>
 */
class EquipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'Division' => fake()->numberBetween(1, 4),
            //
 'idSport' => Sport::factory(),
             'nom' => fake()->word(),
        ];
    }
}
