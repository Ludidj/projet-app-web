<?php

$nomProjet = "SPORTSCHOOL";
$auteur = "LUDIVINE DJENI";
$versionPhp = PHP_VERSION;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nomProjet) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($nomProjet) ?></h1>

    <p>Application Web transactionnelle pour gérer des activités sportives.</p>

    <p>Version PHP : <?= htmlspecialchars($versionPhp) ?></p>

    <p>Auteur : <?= htmlspecialchars($auteur) ?></p>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="recits.php">Récits utilisateurs</a>
        <a href="#">Activités</a>
    </nav>

</body>
</html>