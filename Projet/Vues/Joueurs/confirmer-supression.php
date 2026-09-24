<?php ob_start(); ?>

<h1>Supprimer un joueur</h1>

<p>
    Voulez-vous vraiment retirer ce jouer?
    <strong>
        
    <?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8')?>
         <?= htmlspecialchars($joueur['prénom'], ENT_QUOTES, 'UTF-8') ?>
    </strong>
    ?
    </p>

<form method="post" action="index.php?action=supprimer-joueur">

    <input
        type="hidden"
        name="idJoueur"
        value="<?= (int) $joueur['idJoueurs'] ?>"
    >

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>"
    >

    <button type="submit">
        Oui, supprimer
    </button>

</form>

<p>
    <a href="index.php?action=equipe&id=<?= (int) $joueur['idEquipe'] ?>">
        Annuler
    </a>
</p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
?>