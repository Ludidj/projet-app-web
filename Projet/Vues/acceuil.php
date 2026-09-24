<?php

declare(strict_types=1);

ob_start();
?>

<h1><?= htmlspecialchars($nomProjet, ENT_QUOTES, 'UTF-8') ?></h1>

<p>
    Version PHP :
    <?= htmlspecialchars($versionPhp, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    Projet réalisé par :
    <?= htmlspecialchars($auteur, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    SPORTMANAGER est une application Web qui permet de gérer une ligue
    sportive, ses équipes, ses joueurs et ses activités. Elle facilite
    l'organisation des équipes et permet aux utilisateurs de consulter
    les informations importantes de la ligue.
</p>

<h2>Fonctionnalités prévues</h2>

<nav>
    <ul>
        <li><a href="equipes.php">Gérer les équipes</a></li>
        <li><a href="#">Consulter les joueurs</a></li>
        <li><a href="#">Voir les activités</a></li>
    </ul>
</nav>

<?php

$contenu = ob_get_clean();

require __DIR__ . '/gabarit.php';