<?php ob_start(); ?>

<h1>
    Joueurs de l'équipe
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h1>

<p>
  <a href="index.php?action=ajouter-joueur&idEquipe=<?= (int) $idEquipe ?>">
    Ajouter un joueur
</a>
</p>

<?php if ($joueurs === []): ?>

    <p>Aucun joueur dans cette équipe.</p>

<?php else: ?>

    <?php foreach ($joueurs as $joueur): ?>

        <article>

            <h2>
                <?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8') ?>
                <?= htmlspecialchars($joueur['prénom'], ENT_QUOTES, 'UTF-8') ?>
            </h2>

            <p>Numéro : <?= (int) $joueur['numero'] ?></p>

            <p>Division : <?= (int) $joueur['division'] ?></p>

            <p>Âge : <?= (int) $joueur['age'] ?></p>

            <p>
                Sexe :
                <?= htmlspecialchars($joueur['sexe'], ENT_QUOTES, 'UTF-8') ?>
            </p>

           <p>
   <a href="index.php?action=supprimer-joueur&id=<?= (int) $joueur['idJoueurs'] ?>">
    Supprimer
</a>
</p>

        </article>

    <?php endforeach; ?>

<?php endif; ?>

<p>
    <a href="index.php?action=equipes">
        Retour aux équipes
    </a>
</p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
?>