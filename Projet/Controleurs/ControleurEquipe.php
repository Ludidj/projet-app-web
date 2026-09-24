<?php

declare(strict_types=1);

class ControleurEquipe
{
    private $equipe;
    private $joueur;
    private $vue;

    public function __construct(
        Equipe $equipe,
        Joueur $joueur,
        Vue $vue
    ) {
        $this->equipe = $equipe;
        $this->joueur = $joueur;
        $this->vue = $vue;
    }

    public function afficherEquipes(): void
    {
        $equipes = $this->equipe->obtenirEquipes();

        $this->vue->afficher(
            'Equipes/index',
            [
                'equipes' => $equipes
            ],
            'Équipes'
        );
    }

    public function afficherJoueursEquipe(int $idEquipe): void
    {
        $equipe = $this->equipe->obtenirParId($idEquipe);

        if ($equipe === null) {
            throw new RuntimeException('Équipe introuvable.', 404);
        }

        $joueurs = $this->joueur->obtenirParEquipe($idEquipe);

        $this->vue->afficher(
            'Equipes/Afficher',
            [
                'equipe' => $equipe,
                'joueurs' => $joueurs
            ],
            $equipe['nom']
        );
    }

    public function afficherFormulaireAjoutJoueur(int $idEquipe): void
    {
        $equipe = $this->equipe->obtenirParId($idEquipe);

        if ($equipe === null) {
            throw new RuntimeException('Équipe introuvable.', 404);
        }

        $this->vue->afficher(
            'Joueurs/ajouter-joueur',
            [
                'equipe' => $equipe
            ],
            'Ajouter un joueur'
        );
    }
}