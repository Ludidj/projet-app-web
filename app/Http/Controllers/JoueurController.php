<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;
use App\Models\User;
class JoueurController extends Controller
{
    // Afficher tous les joueurs
    public function index()
    {
        $joueurs = Joueur::with('equipe')->get();

        return view('joueurs.index', compact('joueurs'));
    }

    // Afficher le formulaire de création
    public function create(string $idEquipe)
    {
        $equipe = Equipe::findOrFail($idEquipe);

        return view('joueurs.create', compact('equipe'));
    }

    // Enregistrer un nouveau joueur

public function store(Request $request, string $idEquipe)
{
    $request->validate([
        'nom' => 'required|string',
        'prénom' => 'required|string',
        'email' => 'required|email',
        'numero' => 'required|integer',
        'age' => 'required|integer',
        'sexe' => 'required|string',
    ]);

    // Créer le joueur
    $joueur = Joueur::create([
        'nom' => $request->nom,
        'prénom' => $request->input('prénom'),
        'email' => $request->email,
        'numero' => $request->numero,
        'age' => $request->age,
        'sexe' => $request->sexe,
        'idEquipe' => null,
    ]);

    // Chercher un compte qui possède le même courriel
    $user = User::where('email', $request->email)->first();

    // Associer automatiquement le compte au joueur
    if ($user) {
        $joueur->user_id = $user->id;
        $joueur->save();
    }

    return redirect()->route('equipe.show', $idEquipe);
}

    // Afficher un joueur
    public function show(string $id)
    {
        $joueur = Joueur::with('equipe')->findOrFail($id);

        return view('joueurs.show', compact('joueur'));
    }

    // Afficher le formulaire de modification
    public function edit(string $id)
    {
        $joueur = Joueur::findOrFail($id);

        return view('joueurs.edit', compact('joueur'));
    }

    // Modifier un joueur
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prénom' => 'required|string|max:255',
            'numero' => 'required|integer',
            'age' => 'required|integer',
            'sexe' => 'required|string',
        ]);

        $joueur = Joueur::findOrFail($id);

        $joueur->nom = $request->nom;
        $joueur->{'prénom'} = $request->input('prénom');
        $joueur->numero = $request->numero;
        $joueur->age = $request->age;
        $joueur->sexe = $request->sexe;
        $joueur->save();

        return redirect()
            ->route('equipe.show', $joueur->idEquipe);
    }

    // Supprimer un joueur
    public function destroy(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        $idEquipe = $joueur->idEquipe;

        $joueur->delete();

        return redirect()
            ->route('equipe.show', $idEquipe);
    }

public function ajouter(Request $request, string $idEquipe)
{
    $request->validate([
        'idJoueur' => 'required|integer'
    ]);

    $equipe = Equipe::findOrFail($idEquipe);

    $joueur = Joueur::whereNull('idEquipe')
        ->findOrFail($request->idJoueur);

    $joueur->idEquipe = $equipe->idEquipe;
    $joueur->save();

    return redirect()->route('equipe.show', $equipe->idEquipe);
}
public function retirerDeEquipe(Joueur $joueur)
{
    $joueur->idEquipe = null;
    $joueur->save();

    return redirect()->back()
        ->with('success', 'Joueur retiré de l’équipe.');
}
}
