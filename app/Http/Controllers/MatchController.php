<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Match1;
use App\Models\Equipe;
use App\Models\Sport;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchs = Match1::with(['equipe', 'adversaire'])
            ->orderBy('date')
            ->get();

        return view('match.index', compact('matchs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $sports = Sport::all();

    $equipes = Equipe::where('idSport', $request->idSport)->get();

    return view('match.create', compact('sports', 'equipes'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idSport' => ['required', 'exists:sports,idSports'],

            'idEquipe' => [
                'required',
                Rule::exists('equipe', 'idEquipe')
                    ->where('idSport', $request->idSport),
            ],

            'idAdversaire' => [
                'required',
                'different:idEquipe',
                Rule::exists('equipe', 'idEquipe')
                    ->where('idSport', $request->idSport),
            ],

            'date' => ['required', 'date', 'after_or_equal:today'],
            'Lieu' => ['required', 'string', 'max:100'],
            'heure' => ['required', 'date_format:H:i'],
        ]);

        // Le sport sert seulement à vérifier les équipes.
        // Il n'est pas enregistré dans la table Match.
        unset($data['idSport']);

        $data['statut'] = 'a_venir';

        Match1::create($data);

        return redirect()->route('match.index')
            ->with('success', 'Le match a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $match = Match1::with(['equipe', 'adversaire'])->findOrFail($id);

        return view('match.show', compact('match'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $match = Match1::findOrFail($id);
        $equipes = Equipe::all();

        return view('match.edit', compact('match', 'equipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'statut' => ['required', 'in:a_venir,annule'],
        ]);

        $match = Match1::findOrFail($id);

        $match->update([
            'statut' => $request->statut,
        ]);

        return redirect()->route('match.index')
            ->with('success', 'Le statut du match a été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match = Match1::findOrFail($id);

        $match->delete();

        return redirect()->route('match.index')
            ->with('success', 'Le match a été supprimé.');
    }
}
