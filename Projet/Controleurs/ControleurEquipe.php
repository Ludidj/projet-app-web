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

public function afficherFormulaireModificationJoueur(int $idJoueur): void
{
    $joueur = $this->joueur->obtenirJoueur($idJoueur);

    if ($joueur === null) {
        throw new RuntimeException(
            'Joueur introuvable.',
            404
        );
    }

    $this->vue->afficher(
        'Joueurs/modifier-joueur',
        [
            'joueur' => $joueur
        ],
        'Modifier un joueur'
    );
}

public function modifierJoueur(array $donnees): void
{
    $idJoueur = (int) $donnees['idJoueur'];

    $joueur = $this->joueur->obtenirJoueur($idJoueur);

    if ($joueur === null) {
        throw new RuntimeException(
            'Joueur introuvable.',
            404
        );
    }

    $erreurs = [];

    $nom = trim($donnees['nom'] ?? '');
    $prenom = trim($donnees['prenom'] ?? '');
    $numero = $donnees['numero'] ?? '';
    $division = $donnees['division'] ?? '';
    $age = $donnees['age'] ?? '';
    $sexe = $donnees['sexe'] ?? '';

    if ($nom === '') {
        $erreurs[] = 'Le nom est obligatoire.';
    }

    if ($prenom === '') {
        $erreurs[] = 'Le prénom est obligatoire.';
    }

    if ($numero === '' || filter_var($numero, FILTER_VALIDATE_INT) === false) {
        $erreurs[] = 'Le numéro est invalide.';
    }

    if ($division === '' || filter_var($division, FILTER_VALIDATE_INT) === false) {
        $erreurs[] = 'La division est invalide.';
    }

    if ($age === '' || filter_var($age, FILTER_VALIDATE_INT) === false) {
        $erreurs[] = 'L’âge est invalide.';
    }

    if ($sexe === '') {
        $erreurs[] = 'Le sexe est obligatoire.';
    }

    if (!empty($erreurs)) {
        $this->vue->afficher(
            'Joueurs/modifier-joueur',
            [
                'joueur' => [
                    'idJoueurs' => $idJoueur,
                    'nom' => $nom,
                    'prénom' => $prenom,
                    'numero' => $numero,
                    'division' => $division,
                    'age' => $age,
                    'sexe' => $sexe,
                    'idEquipe' => $joueur['idEquipe']
                ],
                'erreurs' => $erreurs
            ],
            'Modifier un joueur'
        );

        return;
    }

    $this->joueur->modifierJoueur(
        $idJoueur,
        $nom,
        $prenom,
        (int) $numero,
        (int) $division,
        (int) $age,
        $sexe
    );

    header(
        'Location: index.php?action=equipe&id=' . $joueur['idEquipe']
    );
    exit;
}


}

