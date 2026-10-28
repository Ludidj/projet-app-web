<?php
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\RechercheEquipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;

Route::get('/recherche/equipes', RechercheEquipeController::class)
    ->name('recherche.equipes');
Route::resource('equipe', EquipeController::class); // route
Route::get('/', function () {
    return view('welcome');
});
Route::post('/langue', function (Request $request) {
    $data = $request->validate([
        'locale' => ['required', Rule::in(['fr', 'en'])],
    ]);

    $request->session()->put('locale', $data['locale']);

    return back();
})->name('locale.update');
