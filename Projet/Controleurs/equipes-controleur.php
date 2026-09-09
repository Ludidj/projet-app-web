<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../Modèle/equipes-modele.php';

$equipes = obtenirEquipes($pdo);

$titrePage = 'Équipes';

require __DIR__ . '/../Vues/equipes/index.php';