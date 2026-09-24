<?php

declare(strict_types=1);
?>

<h1>Les équipes</h1>

<?php if (empty($equipes)): ?>

    <p>Aucune équipe trouvée.</p>

<?php else: ?>

    <ul>
        <?php foreach ($equipes as $equipe): ?>

            <li>
                <a href="index.php?action=equipe&id=<?= $equipe['idEquipe'] ?>">
                    <?= htmlspecialchars($equipe['nom'], ENT_QUOTES, 'UTF-8') ?>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>

<?php endif; ?>