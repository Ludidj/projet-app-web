<?php
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\RechercheEquipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompteController;
use App\Http\Middleware\EnsureManager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Contracts\View\View;


Route::get('/recherche/equipes', RechercheEquipeController::class)
    ->name('recherche.equipes');

Route::resource('equipe', EquipeController::class)
    ->middlewareFor(['create', 'edit', 'store','update', 'destroy'], 
     ['auth', EnsureManager::class]
    );

Route::post('/langue', function (Request $request) {
    $data = $request->validate([
        'locale' => ['required', Rule::in(['fr', 'en'])],
    ]);

    $request->session()->put('locale', $data['locale']);

    return back();
})->name('locale.update');
Route::get('/inscription', [InscriptionController::class, 'create'])
    ->middleware('guest')->name('register');

Route::post('/inscription', [InscriptionController::class, 'store'])
    ->middleware('guest')->name('register.store');

    

Route::get('/connexion', [AuthController::class, 'create'])
    ->middleware('guest')->name('login');

Route::post('/connexion', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:6,1'])->name('login.store');

Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

    Route::get('/deconnexion', [AuthController::class, 'logout'])
    ->middleware(['guest', 'throttle:6,1']);

    Route::get('/', [EquipeController::class, 'index'])->name('home');
    
Route::get('/compte', [CompteController::class, 'show'])
    ->middleware('auth')->name('account.show');



Route::middleware(['auth', EnsureManager::class])->group(function () {
    Route::get('/administration', fn () => 'Administration')
        ->name('admin.index');
});


Route::get('/email/verify', fn () => view('auth.verify-email'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('equipes.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Lien de vérification envoyé.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
