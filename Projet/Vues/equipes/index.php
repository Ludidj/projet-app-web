<?php ob_start(); ?>

<h1><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (empty($equipes)): ?>

    <p>Aucune équipe dans la base de données.</p>

<?php else: ?>

    <?php foreach ($equipes as $equipe): ?>

        <article>
            <h2>
                <?= htmlspecialchars(
                    (string) $equipe['nom'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </h2>

            <p>
                ID :
                <?= htmlspecialchars(
                    (string) $equipe['idEquipe'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

            <p>
                Division :
                <?= htmlspecialchars(
                    (string) $equipe['Division'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>
        </article>

    <?php endforeach; ?>

<?php endif; ?>

<?php
$contenu = ob_get_clean();

require __DIR__ . '/../gabarit.php';