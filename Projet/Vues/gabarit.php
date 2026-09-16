<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?>
    </title>

    <link rel="stylesheet" href="/Projet/css/style.css">
</head>

<body>

<header>
    <h1>SPORTMANAGER</h1>

    <nav>
        <a href="/projet/index.php">Accueil</a>
        <a href="/projet/equipes.php">Équipes</a>
        <a href="/projet/recits.php">Récits</a>
    </nav>
</header>

<main>
    <?= $contenu ?>
</main>

<footer>
    <p>
       <p>
    <?= htmlspecialchars($auteur ?? 'AUTEUR: Ludivine Djeni', ENT_QUOTES, 'UTF-8') ?>
</p>
    </p>
</footer>

</body>
</html>