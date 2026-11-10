<?php

namespace Tests\Feature;

use App\Models\Equipe;
use App\Models\User;
use App\Models\Sport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EquipeImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_une_equipe_peut_recevoir_une_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_MANAGER,
        ]);

        $sport = Sport::factory()->create();

        $this->actingAs($user)
            ->post(route('equipe.store'), [
                'nom' => 'Équipe illustrée',
                'Division' => 1,
                'idSport' => $sport->idSports,
                'image' => UploadedFile::fake()->create(
    'photo.png',
    100,
    'image/png'
)
            ])
            ->assertRedirect();

        $equipe = Equipe::firstOrFail();

        $this->assertDatabaseHas('equipe', [
            'idEquipe' => $equipe->idEquipe,
            'nom' => 'Équipe illustrée',
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($equipe->image_path);

        Storage::disk('public')->assertExists($equipe->image_path);
    }
}