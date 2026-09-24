<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/'; ?>

    <base href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($titrePage ?? 'SPORTMANAGER', ENT_QUOTES, 'UTF-8') ?>
    </title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

    <h1>SPORTMANAGER</h1>

   /* <nav>
        <a href="">Accueil</a>
        <a href="equipes">Équipes</a>
        <a href="recits">Récits</a>
    </nav>

</header>

<main>

    <?= $contenu ?>

</main>

<footer>

    <p>
        <?= htmlspecialchars(
            $auteur ?? 'AUTEUR: Ludivine Djeni',
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </p>

</footer>

</body>

</html>