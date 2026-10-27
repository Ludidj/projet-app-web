<?php

namespace App\Http\Controllers;
use App\Models\Equipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RechercheEquipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {

    
        //

        $data = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:50'],
        ]);

        $equipes = Equipe::query()
           ->where('nom', 'like', '%'.$data['q'].'%')
            ->orderBy('nom')
            ->limit(8)
            ->get(['idEquipe', 'nom']);

            return response()->Json([
                'data' => $equipes->map(fn (Equipe $equipe) =>[
                    'id' => $equipe-idEquipe,
                    'label' => $equipe->nom,
                    'url'=>route ('equipe.show', $equipe),

                ]),
            ]);
    }
}
