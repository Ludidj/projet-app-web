<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
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
            ->paginate(10);

        return view('equipes.index', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('equipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'idSport' => ['required', 'integer'],
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
        return view('equipes.show', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe): View
    {
        return view('equipes.edit', compact('equipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe): RedirectResponse
    {
        $validated = $request->validate([
            'idSport' => ['required', 'integer'],
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
