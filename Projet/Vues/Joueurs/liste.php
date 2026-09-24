<h1>Joueurs</h1>

<?php if (empty($joueurs)): ?>

    <p>Aucun joueur trouvé.</p>

<?php else: ?>

    <ul>

        <?php foreach ($joueurs as $joueur): ?>

            <li>
              <?= htmlspecialchars($joueur['prénom'], ENT_QUOTES, 'UTF-8') ?>
               <?= htmlspecialchars($joueur['nom'], ENT_QUOTES, 'UTF-8') ?>

               <a class="bouton supprimer" href="index.php?action=supprimer-joueur&id=<?= $joueur['id'] ?>">
    Supprimer
</a>
                 
                </a>
            </li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>