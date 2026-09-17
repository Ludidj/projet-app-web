<?php

declare(strict_types=1);


/*function getJoueur(PDO $pdo, int $idEquipe): array
{
    $sql = "
        SELECT
            idJoueurs,
            nom,
            prénom,
            numero,
            division,
            age,
            sexe
        FROM Joueurs
        WHERE idEquipe = :idEquipe
        ORDER BY nom, prénom
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'idEquipe' => $idEquipe
    ]);

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
*/

function obtenirJoueur(PDO $pdo, int $idJoueur): ?array
{
    $sql = "
        SELECT
            idJoueurs,
            nom,
            prénom,
            numero,
            division,
            age,
            sexe,
            idEquipe
        FROM Joueurs
        WHERE idJoueurs = :idJoueur
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'idJoueur' => $idJoueur
    ]);

    $joueur = $requete->fetch(PDO::FETCH_ASSOC);

    return $joueur ?: null;
}


function supprimerJoueur(PDO $pdo, int $idJoueur): void
{
    $sql = "
        DELETE FROM Joueurs
        WHERE idJoueurs = :idJoueur
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'idJoueur' => $idJoueur
    ]);
}

