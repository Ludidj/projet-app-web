<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::all();

        return view('sports.index', compact('sports'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    Gate::authorized('create', Sport::class);

    return view('sports.create');
        //
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

        Sport::create($donnees);

        return redirect()
            ->route('sports.create')
            ->with('status', 'Sport créé avec succès.');   
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
