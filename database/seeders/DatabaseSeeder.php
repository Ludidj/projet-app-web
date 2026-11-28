<?php

namespace Database\Seeders;

use App\Models\Equipe;
use App\Models\Match1;
use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $sports = [
            [
                'name' => 'Soccer',
                'description' => 'Soccer intérieur et extérieur',
                'arena' => 'Terrain Montmorency',
                'teams' => ['Aigles de Laval', 'Étoiles du Nord', 'Lynx de Montmorency'],
            ],
            [
                'name' => 'Basketball',
                'description' => 'Basketball féminin et masculin',
                'arena' => 'Gymnase principal',
                'teams' => ['Titans de Laval', 'Panthères du Nord', 'Faucons de Laval'],
            ],
            [
                'name' => 'Volleyball',
                'description' => 'Volleyball en salle',
                'arena' => 'Centre sportif Laval',
                'teams' => ['Voltigeurs de Laval', 'Lynx du filet', 'Spikers du Nord'],
            ],
            [
                'name' => 'Hockey',
                'description' => 'Hockey sur glace',
                'arena' => 'Aréna de Laval',
                'teams' => ['Caribous de Laval', 'Loups du Nord', 'Grizzlys Montmorency'],
            ],
            [
                'name' => 'Baseball',
                'description' => 'Baseball scolaire',
                'arena' => 'Parc des Diamants',
                'teams' => ['Coureurs de Laval', 'Diamants du Nord', 'Voltigeurs du Collège'],
            ],
        ];

        $firstNames = [
            'Alexandre', 'Emma', 'Thomas', 'Camille', 'Nathan',
            'Sarah', 'Gabriel', 'Léa', 'Mathis', 'Chloé',
            'Noah', 'Jade', 'William', 'Mia', 'Félix',
        ];
        $lastNames = [
            'Tremblay', 'Gagnon', 'Roy', 'Côté', 'Bouchard',
            'Gauthier', 'Morin', 'Fortin', 'Ouellet', 'Pelletier',
            'Lavoie', 'Bélanger', 'Lévesque', 'Bergeron', 'Paquette',
        ];

        $teamRecords = [];

        foreach ($sports as $sportIndex => $sportData) {
            $sport = Sport::updateOrCreate(
                ['nomSport' => $sportData['name']],
                ['description' => $sportData['description']],
            );

            foreach ($sportData['teams'] as $teamIndex => $teamName) {
                $imagePath = 'equipes/demo-'.Str::slug($teamName).'.svg';
                $imageSaved = Storage::disk('public')->put(
                    $imagePath,
                    $this->teamBadge($teamName, $sportData['name'], $sportIndex + $teamIndex),
                );

                $team = Equipe::updateOrCreate(
                    ['nom' => $teamName],
                    [
                        'idSport' => $sport->idSports,
                        'Division' => ($teamIndex % 3) + 1,
                        'image_path' => $imageSaved ? $imagePath : null,
                        'user_id' => null,
                    ],
                );

                $teamRecords[$sportData['name']][] = $team;

                for ($playerIndex = 0; $playerIndex < 5; $playerIndex++) {
                    $seedIndex = ($sportIndex * 15) + ($teamIndex * 5) + $playerIndex;
                    $jerseyNumber = $playerIndex + 1;

                    DB::table('joueurs')->updateOrInsert(
                        [
                            'idEquipe' => $team->idEquipe,
                            'numero' => $jerseyNumber,
                            'est_seed' => true,
                        ],
                        [
                            'nom' => $lastNames[intdiv($seedIndex, 5) % count($lastNames)],
                            'prénom' => $firstNames[$seedIndex % count($firstNames)],
                            'division' => $team->Division,
                            'age' => 16 + ($seedIndex % 7),
                            'sexe' => $playerIndex % 2 === 0 ? 'M' : 'F',
                            'email' => null,
                            'user_id' => null,
                        ],
                    );
                }
            }
        }

        foreach ($sports as $sportIndex => $sportData) {
            $teams = $teamRecords[$sportData['name']];

            foreach ([[0, 1], [1, 2], [2, 0]] as $fixtureIndex => [$homeIndex, $awayIndex]) {
                Match1::updateOrCreate(
                    [
                        'idEquipe' => $teams[$homeIndex]->idEquipe,
                        'idAdversaire' => $teams[$awayIndex]->idEquipe,
                    ],
                    [
                        'date' => now()->addDays(2 + ($sportIndex * 3) + $fixtureIndex)
                            ->toDateString(),
                        'Lieu' => $sportData['arena'],
                        'heure' => sprintf('%02d:00:00', 17 + $fixtureIndex),
                        'statut' => 'a_venir',
                        'scoreEquipe' => null,
                        'scoreAdversair' => null,
                    ],
                );
            }
        }

        foreach (range(0, 14) as $playerIndex) {
            DB::table('joueurs')->updateOrInsert(
                [
                    'idEquipe' => null,
                    'numero' => 90 + $playerIndex,
                    'est_seed' => true,
                ],
                [
                    'nom' => $lastNames[$playerIndex],
                    'prénom' => $firstNames[$playerIndex],
                    'division' => ($playerIndex % 3) + 1,
                    'age' => 16 + ($playerIndex % 7),
                    'sexe' => $playerIndex % 2 === 0 ? 'M' : 'F',
                    'email' => null,
                    'user_id' => null,
                ],
            );
        }
    }

    private function teamBadge(string $teamName, string $sportName, int $colorIndex): string
    {
        $colors = ['#1D4ED8', '#15803D', '#B91C1C', '#7C3AED', '#C2410C'];
        preg_match_all('/\\b[\\p{L}\\p{N}]/u', $teamName, $matches);
        $initials = mb_strtoupper(implode('', array_slice($matches[0] ?? [], 0, 2)));
        $safeInitials = htmlspecialchars($initials, ENT_QUOTES | ENT_XML1, 'UTF-8');
        $safeSport = htmlspecialchars($sportName, ENT_QUOTES | ENT_XML1, 'UTF-8');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" role="img" aria-label="Logo {$safeSport}">
  <rect width="240" height="240" rx="36" fill="{$colors[$colorIndex % count($colors)]}"/>
  <circle cx="120" cy="105" r="68" fill="#ffffff" fill-opacity="0.16" stroke="#ffffff" stroke-width="5"/>
  <text x="120" y="124" text-anchor="middle" font-family="Arial, sans-serif" font-size="56" font-weight="700" fill="#ffffff">{$safeInitials}</text>
  <text x="120" y="205" text-anchor="middle" font-family="Arial, sans-serif" font-size="16" font-weight="700" fill="#ffffff">{$safeSport}</text>
</svg>
SVG;
    }
}
