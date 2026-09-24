<h1>Se Connecter</h1>

<?php if (!empty($erreur)): ?>
    <p>
        <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post" action="authentifier">

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

    <button type="submit">Se connecter</button>

</form>

<p>
    Vous n'avez pas de compte ?
    <a href="inscription">Créer un compte</a>
</p>