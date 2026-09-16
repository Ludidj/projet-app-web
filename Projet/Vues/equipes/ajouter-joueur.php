<?php ob_start(); ?>

<h1>Ajouter un joueur</h1>

<h2>
    Équipe :
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h2>

<?php if (!empty($erreurs)): ?>

    <div role="alert">
        <h2>Erreurs :</h2>

        <ul>
            <?php foreach ($erreurs as $erreur): ?>
                <li><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<form method="post" action="index.php?action=ajouter-joueur">

    <input
        type="hidden"
        name="idEquipe"
        value="<?= (int) $idEquipe ?>"
    >

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>"
    >

    <p>
        <label for="nom">Nom :</label>

        <input
            type="text"
            id="nom"
            name="nom"
            value="<?= htmlspecialchars($nom ?? '', ENT_QUOTES, 'UTF-8') ?>"
            required
            maxlength="45"
            <?= !empty($erreurs['nom']) ? 'aria-invalid="true" aria-describedby="erreur-nom"' : '' ?>
        >

        <?php if (!empty($erreurs['nom'])): ?>
            <span id="erreur-nom">
                <?= htmlspecialchars($erreurs['nom'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="prenom">Prénom :</label>

        <input
            type="text"
            id="prenom"
            name="prenom"
            value="<?= htmlspecialchars($prenom ?? '', ENT_QUOTES, 'UTF-8') ?>"
            required
            maxlength="45"
            <?= !empty($erreurs['prenom']) ? 'aria-invalid="true" aria-describedby="erreur-prenom"' : '' ?>
        >

        <?php if (!empty($erreurs['prenom'])): ?>
            <span id="erreur-prenom">
                <?= htmlspecialchars($erreurs['prenom'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="numero">Numéro :</label>

        <input
            type="number"
            id="numero"
            name="numero"
            value="<?= htmlspecialchars((string)($numero ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
            <?= !empty($erreurs['numero']) ? 'aria-invalid="true" aria-describedby="erreur-numero"' : '' ?>
        >

        <?php if (!empty($erreurs['numero'])): ?>
            <span id="erreur-numero">
                <?= htmlspecialchars($erreurs['numero'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="division">Division :</label>

        <input
            type="number"
            id="division"
            name="division"
            value="<?= htmlspecialchars((string)($division ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
            <?= !empty($erreurs['division']) ? 'aria-invalid="true" aria-describedby="erreur-division"' : '' ?>
        >

        <?php if (!empty($erreurs['division'])): ?>
            <span id="erreur-division">
                <?= htmlspecialchars($erreurs['division'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="age">Âge :</label>

        <input
            type="number"
            id="age"
            name="age"
            value="<?= htmlspecialchars((string)($age ?? ''), ENT_QUOTES, 'UTF-8') ?>"
            required
            <?= !empty($erreurs['age']) ? 'aria-invalid="true" aria-describedby="erreur-age"' : '' ?>
        >

        <?php if (!empty($erreurs['age'])): ?>
            <span id="erreur-age">
                <?= htmlspecialchars($erreurs['age'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <p>
        <label for="sexe">Sexe :</label>

        <select
            id="sexe"
            name="sexe"
            required
            <?= !empty($erreurs['sexe']) ? 'aria-invalid="true" aria-describedby="erreur-sexe"' : '' ?>
        >
            <option value="">Choisir</option>

            <option value="M" <?= ($sexe ?? '') === 'M' ? 'selected' : '' ?>>
                M
            </option>

            <option value="F" <?= ($sexe ?? '') === 'F' ? 'selected' : '' ?>>
                F
            </option>
        </select>

        <?php if (!empty($erreurs['sexe'])): ?>
            <span id="erreur-sexe">
                <?= htmlspecialchars($erreurs['sexe'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        <?php endif; ?>
    </p>

    <button type="submit">
        Ajouter le joueur
    </button>

</form>

<p>
    <a href="index.php?action=equipe&id=<?= (int) $idEquipe ?>">
        Annuler
    </a>
</p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
?>