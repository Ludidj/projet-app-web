<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;
Route::resource('equipe', EquipeController::class); // route
Route::get('/', function () {
    return view('welcome');
});
