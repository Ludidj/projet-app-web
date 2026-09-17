<?php

declare(strict_types=1);

require_once __DIR__ . '/../Modèle/equipes-modele.php';


function afficherEquipes(PDO $pdo): void
{
    $equipes = obtenirEquipes($pdo);

    $titrePage = 'Liste Équipes';

    require __DIR__ . '/../Vues/equipes/index.php';
}





function afficherJoueursEquipe(PDO $pdo, int $idEquipe): void
{
    $equipe = obtenirEquipe($pdo, $idEquipe);

    if ($equipe === null) {
        http_response_code(404);
        echo 'Équipe introuvable.';
        return;
    }

    $joueurs = obtenirJoueursEquipe($pdo, $idEquipe);

    $titrePage = 'Joueurs de l\'équipe';

    require __DIR__ . '/../Vues/equipes/joueurs.php';
}function afficherFormulaireAjoutJoueur(PDO $pdo, int $idEquipe): void
{
    $equipe = obtenirEquipe($pdo, $idEquipe);

    if ($equipe === null) {
        http_response_code(404);
        echo 'Équipe introuvable.';
        return;
    }

    $titrePage = 'Ajouter un joueur';

    require __DIR__ . '/../Vues/equipes/ajouter-joueur.php';
}
