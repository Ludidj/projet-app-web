<?php

declare(strict_types=1);

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/securite.php';

require_once __DIR__ . '/Modèle/modele.php';
require_once __DIR__ . '/Modèle/Joueur.php';
require_once __DIR__ . '/Modèle/Equipe.php';
require_once __DIR__ . '/Modèle/Utilisateurs.php';

require_once __DIR__ . '/Services/Authentification.php';

require_once __DIR__ . '/Vues/Vue.php';

require_once __DIR__ . '/Controleurs/ControleurAcceuil.php';
require_once __DIR__ . '/Controleurs/ControleurEquipe.php';
require_once __DIR__ . '/Controleurs/ControleurUtilisateur.php';
require_once __DIR__ . '/Controleurs/ControleurErreur.php';

require_once __DIR__ . '/Routage/Routeur.php';


demarrerSession();


$joueur = new Joueur($pdo);
$equipe = new Equipe($pdo);

$authentification = new Authentification();

$vue = new Vue(
    $authentification
);


$controleurAcceuil = new ControleurAcceuil(
    $vue
);

$controleurEquipe = new ControleurEquipe(
    $equipe,
    $joueur,
    $vue
);


$utilisateur = new Utilisateur($pdo);

$controleurErreur = new ControleurErreur(
    $vue
);

$controleurUtilisateur = new ControleurUtilisateur(
    $utilisateur,
    $vue,
    $controleurErreur,
    $authentification
);


$routeur = new Routeur(
    $controleurAcceuil,
    $controleurEquipe,
    $controleurUtilisateur
);


$routeur->router();

