<?php ob_start(); ?>

<h1>
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h1>

<p>
    Division :
    <?= (int) $equipe['Division'] ?>
</p>

<p>
    <a href="index.php?action=joueurs&idEquipe=<?= (int) $equipe['idEquipe'] ?>">
        Voir les joueurs
    </a>
</p>

<p>
    <a href="index.php?action=equipes">
        Retour aux équipes
    </a>
</p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
?>