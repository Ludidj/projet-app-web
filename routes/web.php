<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;
Route::resource('equipe', EquipeController::class);
Route::get('/', function () {
    return view('welcome');
});
