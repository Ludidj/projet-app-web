<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CompteController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();

        $equipes = $user->equipes()->get();
        $joueur = $user->joueur;

        $equipeJoueur = $joueur ? $joueur->equipe : null;

        return view('account.show', compact(
            'user',
            'equipes',
            'equipeJoueur'
        ));
    }
}
