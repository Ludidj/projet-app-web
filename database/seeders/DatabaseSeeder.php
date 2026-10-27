<?php

namespace Database\Seeders;

use App\Models\Sport;
use App\Models\Equipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Sport::factory()->count(5)->create();

        Equipe::factory()->count(12)->create();
    }
}