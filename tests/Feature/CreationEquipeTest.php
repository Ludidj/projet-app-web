<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sport;
use App\Models\Equipe;
use Tests\TestCase;

class CreationEquipeTest extends TestCase
{
    public function test_un_manager_connecte_peut_creer_une_equipe(): void
    {
        // Préparer
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_MANAGER,
        ]);

        $sport = Sport::factory()->create();

        // Agir
        $response = $this->actingAs($user)->post(route('equipe.store'), [
            'nom' => 'Equipe testée',
            'idSport' => $sport->idSports,
            'Division' => 1,
        ]);

        // Vérifier
        $response->assertRedirect();

        $this->assertDatabaseHas('equipe', [
            'nom' => 'Equipe testée',
            'user_id' => $user->id,
            'idSport' => $sport->idSports,
        ]);
    }

    public function test_un_nom_vide_est_refuse(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_MANAGER,
        ]);

        $sport = Sport::factory()->create();

        $this->actingAs($user)
            ->post(route('equipe.store'), [
                'nom' => '',
                'idSport' => $sport->idSports,
                'Division' => 1,
            ])
            ->assertSessionHasErrors('nom');

        $this->assertDatabaseMissing('equipe', [
    'nom' => '',
]);
    }

    public function test_un_autre_compte_ne_peut_pas_modifier_equipe(): void
    {
        // Créer le propriétaire
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_MANAGER,
        ]);

        // Créer un autre utilisateur
        $otherUser = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_MANAGER,
        ]);

        // Créer une équipe
        $sport = Sport::factory()->create();

        $equipe = Equipe::create([
            'nom' => 'Équipe originale',
            'Division' => 1,
            'idSport' => $sport->idSports,
            'user_id' => $user->id,
        ]);

        // L'autre utilisateur tente de modifier l'équipe
        $this->actingAs($otherUser)
            ->put(route('equipe.update', $equipe), [
                'nom' => 'Tentative de modification',
                'Division' => 1,
                'idSport' => $sport->idSports,
            ])
            ->assertForbidden();

        // Vérifier que l'équipe n'a pas été modifiée
        $this->assertDatabaseHas('equipe', [
            'idEquipe' => $equipe->idEquipe,
            'nom' => 'Équipe originale',
            'user_id' => $user->id,
        ]);
    }

   public function test_un_membre_ne_peut_pas_creer_une_equipe(): void
{
    // On crée un utilisateur avec le rôle membre
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'role' => User::ROLE_MEMBER,
    ]);

    // On crée un sport pour fournir un identifiant valide
    $sport = Sport::factory()->create();

    // On connecte le membre et on tente de créer une équipe
    $response = $this->actingAs($user)->post(route('equipe.store'), [
        'nom' => 'Equipe testée',
        'idSport' => $sport->idSports,
        'Division' => 1,
    ]);

    // On vérifie que le serveur refuse la création (erreur 403)
    $response->assertForbidden();

    // On vérifie que l'équipe n'a pas été créée dans la base de données
    $this->assertDatabaseMissing('equipe', [
        'nom' => 'Equipe testée',
        'user_id' => $user->id,
    ]);
}

}