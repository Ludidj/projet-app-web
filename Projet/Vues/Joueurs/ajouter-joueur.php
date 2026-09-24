<h1>Nouveau joueur</h1>

<h2>
    Équipe :
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h2>

<form method="post" action="index.php?action=ajouter-joueur">

    <input
        type="hidden"
        name="idEquipe"
        value="<?= htmlspecialchars((string) $equipe['id'], ENT_QUOTES, 'UTF-8') ?>"
    >

    <p>
        <label for="nom">Nom du joueur :</label>
        <input
            type="text"
            id="nom"
            name="nom"
            required
        >
    </p>

    <p>
        <button type="submit">
            Ajouter
        </button>
    </p>

</form>

<p>
    <a href="index.php?action=equipe&id=<?= $equipe['id'] ?>">
        Retour à l'équipe
    </a>
</p>