<?php

declare(strict_types=1);

class ControleurAccueil
{
    public function afficherAccueil(): void
    {
        $nomProjet = ''; // SPORTMANAGER MAIS HEADER EST DEJA DANS GABARIT
        $auteur = 'Ludivine Djeni';
        $versionPhp = PHP_VERSION;
        $titrePage = $nomProjet;

        require __DIR__ . '/../Vues/recits.php';
    }
}