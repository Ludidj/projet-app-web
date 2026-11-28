<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Match1;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $equipes = $user->equipes()->with('sport')->get();
        $equipeJoueur = null;
        $matchsAvenir = collect();
        $statistiques = [];

        if ($user->role === User::ROLE_MEMBER) {
            $joueur = $user->joueur()->with('equipe.sport')->first();
            $equipeJoueur = $joueur?->equipe;

            if ($equipeJoueur) {
                $matchsAvenir = Match1::with(['equipe', 'adversaire'])
                    ->where('statut', 'a_venir')
                    ->where(function ($query) {
                        $query->whereDate('date', '>', today())
                            ->orWhere(function ($query) {
                                $query->whereDate('date', today())
                                    ->where('heure', '>=', now()->format('H:i:s'));
                            });
                    })
                    ->where(function ($query) use ($equipeJoueur) {
                        $query->where('idEquipe', $equipeJoueur->idEquipe)
                            ->orWhere('idAdversaire', $equipeJoueur->idEquipe);
                    })
                    ->orderBy('date')
                    ->orderBy('heure')
                    ->get();
            }
        }

        if ($user->role === User::ROLE_ADMIN) {
            $statistiques = [
                'joueursCrees' => Joueur::where('created_by', $user->id)->count(),
                'sportsCrees' => Sport::where('created_by', $user->id)->count(),
            ];
        }

        if ($user->role === User::ROLE_MANAGER) {
            $equipeIds = $equipes->pluck('idEquipe');
            $matchsDeSesEquipes = Match1::where(function ($query) use ($equipeIds) {
                $query->whereIn('idEquipe', $equipeIds)
                    ->orWhereIn('idAdversaire', $equipeIds);
            });

            $statistiques = [
                'equipesCreees' => $equipes->count(),
                'matchsAvenir' => (clone $matchsDeSesEquipes)
                    ->where('statut', 'a_venir')
                    ->where(function ($query) {
                        $query->whereDate('date', '>', today())
                            ->orWhere(function ($query) {
                                $query->whereDate('date', today())
                                    ->where('heure', '>=', now()->format('H:i:s'));
                            });
                    })
                    ->count(),
                'matchsAnnules' => (clone $matchsDeSesEquipes)
                    ->where('statut', 'annule')
                    ->count(),
            ];
        }

        return view('account.show', compact(
            'user',
            'equipes',
            'equipeJoueur',
            'matchsAvenir',
            'statistiques',
        ));
    }
}
