<?php

declare(strict_types=1);

class ControleurEquipe
{
    private Equipe $equipe;
    private Joueur $joueur;
    private Vue $vue;

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
    $equipe = $this->equipe->obtenirEquipe($idEquipe);

    if ($equipe === null) {
        throw new RuntimeException(
            'Équipe introuvable.',
            404
        );
    }

    $joueurs = $this->equipe->obtenirJoueursEquipe($idEquipe);

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
        $equipe = $this->equipe->obtenirEquipe($idEquipe);

        if ($equipe === null) {
            throw new RuntimeException(
                'Équipe introuvable.',
                404
            );
        }

        $this->vue->afficher(
            'Joueurs/ajouter-joueur',
            [
                'equipe' => $equipe
            ],
            'Ajouter un joueur'
        );
    }

    public function ajouterJoueur(array $donnees): void
{
    $this->equipe->ajouterJoueur(
        $donnees['nom'],
        $donnees['prenom'],
        (int) $donnees['numero'],
        (int) $donnees['division'],
        (int) $donnees['age'],
        $donnees['sexe'],
        (int) $donnees['idEquipe']
    );

    header(
        'Location: index.php?action=equipe&id=' . $donnees['idEquipe']
    );
    exit;
}
public function confirmerSupression(int $idJoueur): void
{
    $joueur = $this->joueur->obtenirJoueur($idJoueur);

    if ($joueur === null) {
        throw new RuntimeException(
            'Joueur introuvable.',
            404
        );
    }

    $this->vue->afficher(
        'Joueurs/confirmer-supression',
        [
            'joueur' => $joueur
        ],
        'Supprimer un joueur'
    );
}

public function supprimerJoueur(array $donnees): void
{
    $this->joueur->supprimerJoueur(
        (int) $donnees['idJoueur']
    );

    header(
        'Location: index.php?action=equipe&id=' . $donnees['idEquipe']
    );
    exit;
}
}

