<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/projet/style.css">

    <title>
        <?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?>
    </title>

    <link rel="stylesheet" href="/projet/css/style.css">
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
        <?= htmlspecialchars($auteur ?? 'ludivine djeni', ENT_QUOTES, 'UTF-8') ?>
       
    </p>
</footer>

</body>
</html>