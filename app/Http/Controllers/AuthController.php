<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

   

public function login(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (!Auth::attempt($credentials)) {
        return back()
            ->withErrors(['email' => 'Identifiants invalides.'])
            ->onlyInput('email');
    }

    $request->session()->regenerate();

    // Vérifier le rôle après connexion
  if (Auth::user()->role === User::ROLE_ADMIN) {
        return redirect()->route('admin.index');
    }

    return redirect()->route('equipe.index');
}



    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('equipe.index');
    }
}
