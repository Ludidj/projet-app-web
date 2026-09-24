<?php

declare(strict_types=1);

class Authentification
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function connecter(array $utilisateur): void
    {
        session_regenerate_id(true);

        $_SESSION['utilisateur'] = [
            'id' => $utilisateur['id'],
            'nom' => $utilisateur['nom'],
            'prénom' => $utilisateur['prénom'],
            'email' => $utilisateur['email'],
            'type' => $utilisateur['type']
        ];
    }

    public function utilisateur(): ?array
    {
        return $_SESSION['utilisateur'] ?? null;
    }

    public function estConnecte(): bool
    {
        return isset($_SESSION['utilisateur']);
    }

    public function deconnecter(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $parametres = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parametres['path'],
                $parametres['domain'],
                $parametres['secure'],
                $parametres['httponly']
            );
        }

        session_destroy();
    }
}