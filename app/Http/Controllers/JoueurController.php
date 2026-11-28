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
    public function create()
    {
        return view('joueurs.create');
    }

    // Enregistrer un nouveau joueur

public function store(Request $request)
{
    $data = $request->validate([
        'nom' => ['required', 'string', 'max:45'],
        'prénom' => ['required', 'string', 'max:45'],
        'email' => ['required', 'email', 'max:255'],
        'numero' => ['required', 'integer', 'min:1'],
        'age' => ['required', 'integer', 'min:1', 'max:100'],
        'sexe' => ['required', 'string', 'max:45'],
    ]);

    $user = User::where('email', $data['email'])
        ->whereDoesntHave('joueur')
        ->first();

    Joueur::create([
        ...$data,
        'idEquipe' => null,
        'division' => null,
        'user_id' => $user?->id,
        'created_by' => $request->user()->id,
    ]);

    return redirect()
        ->route('joueurs.create')
        ->with('status', 'Le joueur est disponible dans les listes des entraineur.');
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
    $joueur->division = $equipe->Division;
    $joueur->save();

    return redirect()
        ->route('equipe.show', $equipe->idEquipe)
        ->with('status', 'Le joueur a été ajouté à l’équipe.');
}
public function retirerDeEquipe(Joueur $joueur)
{
    $joueur->idEquipe = null;
    $joueur->save();

    return redirect()->back()
        ->with('success', 'Joueur retiré de l’équipe.');
}
}
