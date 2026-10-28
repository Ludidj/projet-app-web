<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Throwable;
use App\Http\Requests\EnregistrerEquipeRequest;

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
    public function store(EnregistrerEquipeRequest $request): RedirectResponse
    {
         /*$validated = $request->validate([
            'idSport' => ['required', 'exists:sports,idSports'],
            'nom' => ['required', 'string', 'max:45'],
            'Division' => ['nullable', 'integer'],
        ]);*/

   $data = $request->safe()->except('image');

    $path = $request->file('image')
        ?->store('equipes', 'public');

    try {
        $equipe = Equipe::create([
            ...$data,
            'image_path' => $path,
        ]);
    } catch (Throwable $exception) {
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        throw $exception;
    }

    return redirect()
        ->route('equipe.show', $equipe)
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
   public function update(EnregistrerEquipeRequest $request, Equipe $equipe): RedirectResponse
{
    $data = $request->safe()->except('image');
    $newPath = $request->file('image')?->store('equipes', 'public');
    $oldPath = $equipe->image_path;

    try {
        $equipe->update([
            ...$data,
            ...($newPath ? ['image_path' => $newPath] : []),
        ]);
    } catch (Throwable $exception) {
        if ($newPath) {
            Storage::disk('public')->delete($newPath);
        }

        throw $exception;
    }

    if ($newPath && $oldPath) {
        Storage::disk('public')->delete($oldPath);
    }

    return redirect()->route('equipe.show', $equipe)
        ->with('status', 'Équipe modifiée.');
}

               

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe): RedirectResponse
    {
        $equipe->delete();

        return redirect()->route('equipe.index')
            ->with('status', 'Équipe supprimée.');
    }
}