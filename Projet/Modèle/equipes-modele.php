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

    return $requete->fetchAll();
}