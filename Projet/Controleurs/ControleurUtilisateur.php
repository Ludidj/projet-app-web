<?php

declare(strict_types=1);

class ControleurUtilisateur
{
    private Utilisateur $utilisateur;
    private Vue $vue;
    private ControleurErreur $controleurErreur;
    private Authentification $authentification;

    public function __construct(
        Utilisateur $utilisateur,
        Vue $vue,
        ControleurErreur $controleurErreur,
        Authentification $authentification
    ) {
        $this->utilisateur = $utilisateur;
        $this->vue = $vue;
        $this->controleurErreur = $controleurErreur;
        $this->authentification = $authentification;
    }

    public function inscription(): void
    {
        $this->vue->afficher(
            'utilisateurs/inscription',
            [],
            'Créer un compte'
        );
    }

    public function creerCompte(): void
    {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mdp = $_POST['mdp'] ?? '';
        $confirmation = $_POST['confirmation'] ?? '';
        $type = $_POST['type'] ?? '';

        $erreurs = [];

        if ($nom === '') {
            $erreurs[] = 'Le nom est obligatoire.';
        }

        if ($prenom === '') {
            $erreurs[] = 'Le prénom est obligatoire.';
        }

        if ($email === '') {
            $erreurs[] = 'Le courriel est obligatoire.';
        }

        if ($mdp === '') {
            $erreurs[] = 'Le mot de passe est obligatoire.';
        }

        if ($mdp !== $confirmation) {
            $erreurs[] = 'Les mots de passe ne correspondent pas.';
        }

        if (!in_array($type, ['joueur', 'coach', 'ressource_humaine'], true)) {
            $erreurs[] = 'Le type d’utilisateur est invalide.';
        }

        if ($this->utilisateur->trouverParEmail($email) !== null) {
            $erreurs[] = 'Cette adresse courriel est déjà utilisée.';
        }

        if (!empty($erreurs)) {
            $this->vue->afficher(
                'utilisateurs/inscription',
                [
                    'erreurs' => $erreurs,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'type' => $type
                ],
                'Créer un compte'
            );

            return;
        }

        $this->utilisateur->creer(
            $nom,
            $prenom,
            $email,
            $mdp,
            $type
        );

        header('Location: connexion');
        exit;
    }

    public function connexion(): void
    {
        if ($this->authentification->estConnecte()) {
            header('Location: accueil');
            exit;
        }

        $this->vue->afficher(
            'utilisateurs/connexion',
            [],
            'Connexion'
        );
    }

    public function authentifier(): void
    {
        $email = trim($_POST['email'] ?? '');
        $mdp = $_POST['mdp'] ?? '';

        $utilisateur = $this->utilisateur->trouverParEmail($email);

        if (
            $utilisateur === null ||
            !password_verify($mdp, $utilisateur['mdp'])
        ) {
            $this->vue->afficher(
                'utilisateurs/connexion',
                [
                    'erreur' => 'Courriel ou mot de passe incorrect.',
                    'email' => $email
                ],
                'Connexion'
            );

            return;
        }

        $this->authentification->connecter($utilisateur);

        header('Location: accueil');
        exit;
    }

    public function deconnecter(): void
    {
        $this->authentification->deconnecter();

        header('Location: accueil');
        exit;
    }
}