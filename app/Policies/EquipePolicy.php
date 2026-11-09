<?php

namespace App\Policies;

use App\Models\Equipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EquipePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Equipe $equipe): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equipe $equipe): bool
    {

    return $equipe->user_id === $user->id;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equipe $equipe): bool
    {

    return $this->update($user, $equipe);
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Equipe $equipe): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Equipe $equipe): bool
    {
        return false;
    }


    public function test_un_autre_compte_ne_peut_pas_modifier_equipe(): void
{
    // Créer le propriétaire de l'équipe
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    // Créer un autre utilisateur
    $otherUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    // Créer une équipe appartenant au premier utilisateur
    $equipe = Equipe::create([
        'nom' => 'Équipe originale',
        'Division' => 1,
        'idSport' => 1,
        'user_id' => $user->id,
    ]);

    // L'autre utilisateur tente de modifier l'équipe
    $this->actingAs($otherUser)
        ->put(route('equipe.update', $equipe), [
            'nom' => 'Tentative de modification',
            'Division' => 1,
            'idSport' => 1,
        ])
        ->assertForbidden();

    // Vérifier que les données originales sont conservées
    $this->assertDatabaseHas('equipe', [
        'idEquipe' => $equipe->idEquipe,
        'nom' => 'Équipe originale',
        'user_id' => $user->id,
    ]);
}
}
