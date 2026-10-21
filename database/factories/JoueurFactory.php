<?php

namespace Database\Factories;

use App\Models\Joueur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Joueur>
 */
class JoueurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        'prenom'=> fake()->firstName(),
        'nom'=>fake()->name()
        

        

            //
        ];
    }
}
