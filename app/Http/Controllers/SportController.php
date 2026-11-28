<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Models\Sport;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::withCount('equipes')
            ->orderBy('nomSport')
            ->get();

        return view('sports.index', compact('sports'));
    }

    /** Display the teams that practice a sport. */
    public function show(string $id)
    {
        $sport = Sport::with(['equipes' => fn ($query) => $query->orderBy('nom')])
            ->findOrFail($id);

        return view('sports.show', compact('sport'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    Gate::authorize('create', Sport::class);

    return view('sports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Gate::authorize('create', Sport::class);

        $donnees = $request->validate([
            'nomSport' => 'required|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);

        Sport::create([
            ...$donnees,
            'created_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('sports.create')
            ->with('status', 'Sport créé avec succès.');   
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
