<?php

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\RechercheEquipeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\MatchController;

use App\Http\Middleware\EnsureManager;
use App\Http\Middleware\EnsureAdmin;


// Recherche des équipes
Route::get('/recherche/equipes', RechercheEquipeController::class)
    ->name('recherche.equipes');


// Équipes
Route::resource('equipe', EquipeController::class)
    ->middlewareFor(
        ['create', 'edit', 'store', 'update', 'destroy'],
        ['auth', EnsureManager::class]
    );


// Changer la langue
Route::post('/langue', function (Request $request) {
    $data = $request->validate([
        'locale' => ['required', Rule::in(['fr', 'en'])],
    ]);

    $request->session()->put('locale', $data['locale']);

    return back();
})->name('locale.update');


// Inscription
Route::get('/inscription', [InscriptionController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/inscription', [InscriptionController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');


// Connexion
Route::get('/connexion', [AuthController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/connexion', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:6,1'])
    ->name('login.store');


// Déconnexion
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Accueil
Route::get('/', [EquipeController::class, 'index'])
    ->name('home');


// Compte
Route::get('/compte', [CompteController::class, 'show'])
    ->middleware('auth')
    ->name('account.show');


// Administration
Route::middleware(['auth', EnsureAdmin::class])->group(function () {
    Route::get('/administration', fn () => 'Administration')
        ->name('admin.index');
});


// Vérification du courriel
Route::get('/email/verify', fn () => view('auth.verify-email'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('equipe.index');
})->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Lien de vérification envoyé.');
})->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');


// Sports : consultation
Route::get('/sports', [SportController::class, 'index'])
    ->middleware('auth')
    ->name('sports.index');


// Sports : création par l'administrateur
Route::middleware(['auth', EnsureAdmin::class])->group(function () {

    Route::get('/sports/create', [SportController::class, 'create'])
        ->name('sports.create');

    Route::post('/sports', [SportController::class, 'store'])
        ->name('sports.store');

});


// Joueurs : consultation
Route::resource('joueurs', JoueurController::class)
    ->only(['index', 'show'])
    ->middleware('auth');


// Joueurs : création par l'administrateur
Route::middleware(['auth', EnsureAdmin::class])->group(function () {

    Route::get('/equipe/{idEquipe}/joueurs/create', [JoueurController::class, 'create'])
        ->name('joueurs.create');

    Route::post('/equipe/{idEquipe}/joueurs', [JoueurController::class, 'store'])
        ->name('joueurs.store');

});


// Gestion des joueurs dans les équipes par l'entraîneur
Route::middleware(['auth', EnsureManager::class])->group(function () {

    Route::post('/equipe/{idEquipe}/joueurs/ajouter', [JoueurController::class, 'ajouter'])
        ->name('joueurs.ajouter');

    Route::patch('/joueurs/{joueur}/retirer', [JoueurController::class, 'retirerDeEquipe'])
        ->name('joueurs.retirer');

});


// Matchs : consultation
Route::resource('match', MatchController::class)
    ->only(['index', 'show'])
    ->middleware('auth');


// Matchs : gestion par l'entraîneur
Route::resource('match', MatchController::class)
    ->only(['create', 'store', 'edit', 'update'])
    ->middleware(['auth', EnsureManager::class]);

Route::get('/test-cookie', function () {
    $response = response('Cookie test')
        ->cookie('test_cookie', '123', 60);

    dd($response->headers->all());

    return $response;
});

Route::get('/test-laravel-cookie', function () {
    return response('Test Laravel')
        ->header('X-Test', 'Laravel-OK')
        ->cookie('test_cookie', '123', 60);
});
