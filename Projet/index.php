<?php

declare(strict_types=1);

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Modèle/equipes-modele.php';
require_once __DIR__ . '/Controleurs/equipes-controleur.php';
require_once __DIR__ . '/Controleurs/accueil-controleur.php';
require_once __DIR__ . '/Modèle/joueur-modele.php';

demarrerSession();

$action = $_GET['action'] ?? 'accueil';

try {

    switch ($action) {

        // Accueil
        case 'accueil':
            afficherAccueil();
            break;


        // Liste des équipes
        case 'equipes':
            afficherEquipes($pdo);
            break;


        // Afficher les joueurs d'une équipe
        case 'equipe':

            $idEquipe = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            if ($idEquipe === false || $idEquipe === null) {
                http_response_code(400);
                echo 'Identifiant d\'équipe invalide.';
                break;
            }

            afficherJoueursEquipe($pdo, $idEquipe);
            break;


        // Ajouter un joueur
      case 'ajouter-joueur':

    // POST : traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Vérification CSRF
        if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
            http_response_code(403);
            echo 'Jeton CSRF invalide.';
            break;
        }

        // Valeurs du formulaire
        $idEquipe = filter_input(
            INPUT_POST,
            'idEquipe',
            FILTER_VALIDATE_INT
        );

        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');

        $numero = filter_input(
            INPUT_POST,
            'numero',
            FILTER_VALIDATE_INT
        );

        $division = filter_input(
            INPUT_POST,
            'division',
            FILTER_VALIDATE_INT
        );

        $age = filter_input(
            INPUT_POST,
            'age',
            FILTER_VALIDATE_INT
        );

        $sexe = $_POST['sexe'] ?? '';

        // Vérification de l'identifiant de l'équipe
        if ($idEquipe === false || $idEquipe === null) {
            http_response_code(400);
            echo 'Identifiant d\'équipe invalide.';
            break;
        }

        // Tableau des erreurs
        $erreurs = [];

        // Validation du nom
        if ($nom === '') {
            $erreurs['nom'] = 'Le nom est obligatoire.';
        } elseif (mb_strlen($nom) > 45) {
            $erreurs['nom'] = 'Le nom doit contenir au maximum 45 caractères.';
        }

        if ($prenom === '') {
            $erreurs['prenom'] = 'Le prénom est obligatoire.';
        } elseif (mb_strlen($prenom) > 45) {
            $erreurs['prenom'] = 'Le prénom doit contenir au maximum 45 caractères.';
        }

        if ($numero === false || $numero === null) {
            $erreurs['numero'] = 'Le numéro est obligatoire et doit être un nombre.';
        }

     
        if ($division === false || $division === null) {
            $erreurs['division'] = 'La division est obligatoire et doit être un nombre.';
        }

       
        if ($age === false || $age === null) {
            $erreurs['age'] = 'L\'âge est obligatoire et doit être un nombre.';
        }

        
        if ($sexe !== 'M' && $sexe !== 'F') {
            $erreurs['sexe'] = 'Veuillez choisir un sexe.';
        }

        $equipe = obtenirEquipe($pdo, $idEquipe);

        if ($equipe === null) {
            http_response_code(404);
            echo 'Équipe introuvable.';
            break;
        }

        if ($erreurs !== []) {

            $titrePage = 'Ajouter un joueur';

            require __DIR__ . '/Vues/equipes/ajouter-joueur.php';

            break;
        }


        ajouterJoueur(
            $pdo,
            $nom,
            $prenom,
            $numero,
            $division,
            $age,
            $sexe,
            $idEquipe
        );

    
        header(
            'Location: index.php?action=equipe&id=' . $idEquipe
        );

        exit;
    }


    $idEquipe = filter_input(
        INPUT_GET,
        'idEquipe',
        FILTER_VALIDATE_INT
    );

    if ($idEquipe === false || $idEquipe === null) {
        http_response_code(400);
        echo 'Identifiant d\'équipe invalide.';
        break;
    }

    afficherFormulaireAjoutJoueur($pdo, $idEquipe);

    break;
       
        case 'supprimer-joueur':

            // POST : effectuer la suppression
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Vérifier le CSRF
                if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
                    http_response_code(403);
                    echo 'Jeton CSRF invalide.';
                    break;
                }

                $idJoueur = filter_input(
                    INPUT_POST,
                    'idJoueur',
                    FILTER_VALIDATE_INT
                );

                if ($idJoueur === false || $idJoueur === null) {
                    http_response_code(400);
                    echo 'Identifiant du joueur invalide.';
                    break;
                }

                $joueur = obtenirJoueur($pdo, $idJoueur);

                if ($joueur === null) {
                    http_response_code(404);
                    echo 'Joueur introuvable.';
                    break;
                }

               
                supprimerJoueur($pdo, $idJoueur);

                
                header(
                    'Location: index.php?action=equipe&id=' . $joueur['idEquipe']
                );

                exit;
            }


         

            $idJoueur = filter_input(
                INPUT_GET,
                'id',
                FILTER_VALIDATE_INT
            );

            if ($idJoueur === false || $idJoueur === null) {
                http_response_code(400);
                echo 'Identifiant du joueur invalide.';
                break;
            }

          
            $joueur = obtenirJoueur($pdo, $idJoueur);

            if ($joueur === null) {
                http_response_code(404);
                echo 'Joueur introuvable.';
                break;
            }

            $titrePage = 'Supprimer un joueur';

            require __DIR__ . '/Vues/equipes/confirmer-supression.php';

            break;


        // Route inconnue
        default:
            http_response_code(404);
            echo 'Page introuvable.';
            break;
    }

} catch (Throwable $exception) {

    http_response_code(500);

    echo '<h1>Erreur</h1>';
    echo '<p>Une erreur est survenue.</p>';
}