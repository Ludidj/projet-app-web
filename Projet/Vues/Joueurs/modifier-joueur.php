
<h1>Modifier un joueur</h1>

<?php if (!empty($erreurs)): ?>

    <ul>
        <?php foreach ($erreurs as $erreur): ?>

            <li>
                <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
            </li>

        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<form method="post" action="modifier-joueur-enregistrer">

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>"
    >

    <input
        type="hidden"
        name="idJoueur"
        value="<?= (int) $joueur['idJoueurs'] ?>"
    >

    <div>
        <label for="nom">Nom :</label>
        <input
            type="text"
            id="nom"
            name="nom"
            value="<?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="prenom">Prénom :</label>
        <input
            type="text"
            id="prenom"
            name="prenom"
            value="<?= htmlspecialchars($joueur['prénom'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="numero">Numéro :</label>
        <input
            type="number"
            id="numero"
            name="numero"
            value="<?= htmlspecialchars((string) $joueur['numero'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="division">Division :</label>
        <input
            type="number"
            id="division"
            name="division"
            value="<?= htmlspecialchars((string) $joueur['division'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="age">Âge :</label>
        <input
            type="number"
            id="age"
            name="age"
            value="<?= htmlspecialchars((string) $joueur['age'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">

            <option value="F" <?= $joueur['sexe'] === 'F' ? 'selected' : '' ?>>
                Féminin
            </option>

            <option value="M" <?= $joueur['sexe'] === 'M' ? 'selected' : '' ?>>
                Masculin
            </option>

        </select>
    </div>

    <button type="submit">
        Modifier le joueur
    </button>

</form>

