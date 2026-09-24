<h1>
    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
</h1>

<p>
    <a href="index.php?action=equipes">
        Retour aux équipes
    </a>
</p>

<h2>Liste des joueurs</h2>

<p>
    <a href="index.php?action=ajouter-joueur&idEquipe=<?= $equipe['id'] ?>">
        Ajouter un joueur
    </a>
</p>

<?php if (empty($joueurs)): ?>

    <p>Aucun joueur dans cette équipe.</p>

<?php else: ?>

    <ul>

        <?php foreach ($joueurs as $joueur): ?>

            <li>
                <?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8') ?>

                <a href="index.php?action=supprimer-joueur&id=<?= $joueur['id'] ?>">
                    Supprimer
                </a>
            </li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>