<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JoueurSeeder extends Seeder
{
    public function run(): void
    {
       $joueurs = [
    ['Alexandre', 'Tremblay', 12, 1, 18, 'M'],
    ['Emma', 'Gagnon', 7, 1, 17, 'F'],
    ['Thomas', 'Roy', 15, 2, 21, 'M'],
    ['Camille', 'Côté', 9, 1, 16, 'F'],
    ['Nathan', 'Bouchard', 4, 2, 22, 'M'],
    ['Sarah', 'Gauthier', 11, 2, 20, 'F'],
    ['Gabriel', 'Morin', 3, 1, 17, 'M'],
    ['Léa', 'Fortin', 8, 2, 19, 'F'],
    ['Mathis', 'Ouellet', 14, 1, 18, 'M'],
    ['Chloé', 'Pelletier', 6, 2, 20, 'F'],
];
        foreach ($joueurs as $joueur) {
            DB::table('joueurs')->updateOrInsert(
                [
                    'nom' => $joueur[1],
                    'prénom' => $joueur[0],
                ],
                [
                    'numero' => $joueur[2],
                    'division' => $joueur[3],
                    'age' => $joueur[4],
                    'sexe' => $joueur[5],
                    'idEquipe' => null,
                    'est_seed' => true,
                ]
            );
        }
    }
}
