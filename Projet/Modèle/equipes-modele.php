<?php

declare(strict_types=1);


function obtenirEquipes(PDO $pdo): array
{
    $sql = "
        SELECT
            idEquipe,
            nom,
            Division
        FROM Equipe
        ORDER BY nom
    ";

    $requete = $pdo->prepare($sql);
    $requete->execute();

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function obtenirEquipe(PDO $pdo, int $id): ?array
{
    $sql = "
        SELECT
            idEquipe,
            nom,
            Division,
            idSport
        FROM Equipe
        WHERE idEquipe = :id
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'id' => $id
    ]);

    $equipe = $requete->fetch(PDO::FETCH_ASSOC);

    return $equipe ?: null;
}


function obtenirJoueursEquipe(PDO $pdo, int $idEquipe): array
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
        WHERE idEquipe = :idEquipe
        ORDER BY nom
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'idEquipe' => $idEquipe
    ]);

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function ajouterJoueur(
    PDO $pdo,
    string $nom,
    string $prenom,
    int $numero,
    int $division,
    int $age,
    string $sexe,
    int $idEquipe
): void {

    $sql = "
        INSERT INTO Joueurs
        (
            nom,
            prénom,
            numero,
            division,
            age,
            sexe,
            idEquipe
        )
        VALUES
        (
            :nom,
            :prenom,
            :numero,
            :division,
            :age,
            :sexe,
            :idEquipe
        )
    ";

    $requete = $pdo->prepare($sql);

    $requete->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'numero' => $numero,
        'division' => $division,
        'age' => $age,
        'sexe' => $sexe,
        'idEquipe' => $idEquipe
    ]);
}