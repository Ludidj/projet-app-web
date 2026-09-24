<?php

declare(strict_types=1);

class Routeur
{
    private $controleurAcceuil;
    private $controleurEquipe;

    public function __construct(
        ControleurAcceuil $controleurAcceuil,
        ControleurEquipe $controleurEquipe
    ) {
        $this->controleurAcceuil = $controleurAcceuil;
        $this->controleurEquipe = $controleurEquipe;
    }

    public function router(): void
    {
        $action = $_GET['action'] ?? 'accueil';

        switch ($action) {

            case 'accueil':
                $this->controleurAcceuil->afficherAcceuil();
                break;

            case 'equipes':
                $this->controleurEquipe->afficherEquipes();
                break;

            case 'equipe':
                $idEquipe = filter_input(
                    INPUT_GET,
                    'id',
                    FILTER_VALIDATE_INT
                );

                if ($idEquipe === false || $idEquipe === null) {
                    throw new InvalidArgumentException(
                        'Identifiant d’équipe invalide.',
                        400
                    );
                }

                $this->controleurEquipe->afficherJoueursEquipe($idEquipe);
                break;

            case 'supprimer-joueur':

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->controleurEquipe->supprimerJoueur($_POST);

                } else {

                    $idJoueur = filter_input(
                        INPUT_GET,
                        'id',
                        FILTER_VALIDATE_INT
                    );

                    if ($idJoueur === false || $idJoueur === null) {
                        throw new InvalidArgumentException(
                            'Identifiant du joueur invalide.',
                            400
                        );
                    }

                    $this->controleurEquipe->supprimerJoueur($idJoueur);
                }

                break;

            case 'ajouter-joueur':

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $this->controleurEquipe->ajouterJoueur($_POST);

                } else {

                    $idEquipe = filter_input(
                        INPUT_GET,
                        'idEquipe',
                        FILTER_VALIDATE_INT
                    );

                    if ($idEquipe === false || $idEquipe === null) {
                        throw new InvalidArgumentException(
                            'Identifiant d’équipe invalide.',
                            400
                        );
                    }

                    $this->controleurEquipe
                        ->afficherFormulaireAjoutJoueur($idEquipe);
                }

                break;

            case 'confirmer-supression':

                $idJoueur = filter_input(
                    INPUT_GET,
                    'id',
                    FILTER_VALIDATE_INT
                );

                if ($idJoueur === false || $idJoueur === null) {
                    throw new InvalidArgumentException(
                        'Identifiant du joueur invalide.',
                        400
                    );
                }

                $this->controleurEquipe
                    ->confirmerSupression($idJoueur);

                break;

            default:
                http_response_code(404);
                echo 'Page introuvable.';
                break;
        }
    }
}