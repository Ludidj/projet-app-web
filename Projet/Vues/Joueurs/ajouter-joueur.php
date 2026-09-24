<h1>Nouveau joueur</h1>

<h2>
    Équipe :
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h2>

<form method="post" action="index.php?action=ajouter-joueur">

    <input
        type="hidden"
        name="idEquipe"
        value="<?= htmlspecialchars((string) $equipe['idEquipe'], ENT_QUOTES, 'UTF-8') ?>"
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
        <label for="prenom">Prénom du joueur :</label>
        <input
            type="text"
            id="prenom"
            name="prenom"
            required
        >
    </p>

    <p>
        <label for="numero">Numéro :</label>
        <input
            type="number"
            id="numero"
            name="numero"
            required
        >
    </p>

    <p>
        <label for="division">Division :</label>
        <input
            type="number"
            id="division"
            name="division"
            required
        >
    </p>

    <p>
        <label for="age">Âge :</label>
        <input
            type="number"
            id="age"
            name="age"
            required
        >
    </p>

    
       <p>
    <label for="sexe">Sexe :</label>

    <select
        id="sexe"
        name="sexe"
        required
    >
        <option value="">-- Choisir --</option>
        <option value="M">M</option>
        <option value="F">F</option>
    </select>

    </p>

    <p>
        <button type="submit">
            Ajouter
        </button>
    </p>

</form>

<p>
    <a href="index.php?action=equipe&id=<?= $equipe['idEquipe'] ?>">
        Retour à l'équipe
    </a>
</p>