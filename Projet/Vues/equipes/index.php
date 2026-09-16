<?php ob_start(); ?>

<h1>Équipes</h1>

<?php if ($equipes === []): ?>

    <p>Aucune équipe pour le moment.</p>

<?php else: ?>

    <?php foreach ($equipes as $equipe): ?>

        <article>

            <h2>
                <a href="/projet/index.php?action=equipe&id=<?= (int) $equipe['idEquipe'] ?>">
                    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>  </a>
            </h2>

            <p>
                Division :
                <?= (int) $equipe['Division'] ?>
            </p>

        </article>

    <?php endforeach; ?>

<?php endif; ?>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
?>