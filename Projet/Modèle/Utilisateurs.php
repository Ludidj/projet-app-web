<?php

declare(strict_types=1);

class Utilisateur extends Modele
{
    public function creer(
        string $nom,
        string $prénom,
        string $email,
        string $mdp,
        string $type
    ): bool {
        $motDePasseHash = password_hash($mdp, PASSWORD_DEFAULT);

        $sql = "
            INSERT INTO utilisateurs
                (nom, prénom, email, mdp, type)
            VALUES
                (:nom, :prénom, :email, :mdp, :type)
        ";

        $this->executer($sql, [
            'nom' => $nom,
            'prénom' => $prénom,
            'email' => $email,
            'mdp' => $motDePasseHash,
            'type' => $type
        ]);

        return true;
    }

    public function trouverParEmail(string $email): ?array
    {
        $sql = "
            SELECT *
            FROM utilisateurs
            WHERE email = :email
        ";

        $requete = $this->executer($sql, [
            'email' => $email
        ]);

        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        return $utilisateur ?: null;
    }
}