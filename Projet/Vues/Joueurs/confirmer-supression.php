<h1>Supprimer un joueur</h1>

<p>
    êtes vous sur de vouloir supprimer

    <strong>
        <?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8') ?>
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
        name="idEquipe"
        value="<?= (int) $joueur['idEquipe'] ?>"
    >

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>"
    >

    <button type="submit">
        confirmer
    </button>

</form>