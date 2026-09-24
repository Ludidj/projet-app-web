<h1>Créer un compte</h1>

<?php if (!empty($erreurs)): ?>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li>
                <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="creer-compte">

    <div>
        <label for="nom">Nom :</label>
        <input
            type="text"
            id="nom"
            name="nom"
            value="<?= htmlspecialchars($nom ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="prenom">Prénom :</label>
        <input
            type="text"
            id="prenom"
            name="prenom"
            value="<?= htmlspecialchars($prenom ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="email">Courriel :</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div>
        <label for="mdp">Mot de passe :</label>
        <input
            type="password"
            id="mdp"
            name="mdp"
        >
    </div>

    <div>
        <label for="confirmation">Confirmer le mot de passe :</label>
        <input
            type="password"
            id="confirmation"
            name="confirmation"
        >
    </div>

    <div>
        <label for="type">Type :</label>
        <select id="type" name="type">
            <option value="joueur" <?= ($type ?? '') === 'joueur' ? 'selected' : '' ?>>
                Joueur
            </option>

            <option value="coach" <?= ($type ?? '') === 'coach' ? 'selected' : '' ?>>
                Coach
            </option>

            <option value="ressource_humaine" <?= ($type ?? '') === 'ressource_humaine' ? 'selected' : '' ?>>
                Ressource humaine
            </option>
        </select>
    </div>

    <button type="submit">Créer mon compte</button>

</form>