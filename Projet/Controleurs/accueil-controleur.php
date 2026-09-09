<?php

declare(strict_types=1);

function afficherAccueil(): void
{
    $nomProjet = 'SPORTMANAGER';
    $auteur = 'Ludivine Djeni';
    $versionPhp = PHP_VERSION;
    $titrePage = $nomProjet;

    require __DIR__ . '/../Vues/accueil.php';
}