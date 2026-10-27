<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $equipes = Equipe::query()
            ->with('sport')
            ->paginate(10);

        return view('equipes.index', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sports = Sport::all();

        return view('equipes.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'idSport' => ['required', 'exists:sports,idSports'],
            'nom' => ['required', 'string', 'max:45'],
            'Division' => ['nullable', 'integer'],
        ]);

        $equipe = Equipe::create($validated);

        return redirect()->route('equipes.show', $equipe)
            ->with('status', 'Équipe créée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe): View
    {
        $equipe->load('sport');

        return view('equipes.show', compact('equipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe): View
    {
        $sports = Sport::all();

        return view('equipes.edit', compact('equipe', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe): RedirectResponse
    {
        $validated = $request->validate([
            'idSport' => ['required', 'exists:sports,idSports'],
            'nom' => ['required', 'string', 'max:45'],
            'Division' => ['nullable', 'integer'],
        ]);

        $equipe->update($validated);

        return redirect()->route('equipes.show', $equipe)
            ->with('status', 'Équipe modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe): RedirectResponse
    {
        $equipe->delete();

        return redirect()->route('equipes.index')
            ->with('status', 'Équipe supprimée.');
    }
}