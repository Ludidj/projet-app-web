<?php

declare(strict_types=1);

class Equipe extends Modele
{
    public function obtenirEquipes(): array
    {
        $sql = "
            SELECT
                idEquipe,
                nom,
                Division
            FROM Equipe
            ORDER BY nom
        ";

        $requete = $this->executer($sql);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenirEquipe(int $id): ?array
    {
        $sql = "
            SELECT
                idEquipe,
                nom,
                Division,
                idSport
            FROM Equipe
            WHERE idEquipe = :id
        ";

        $requete = $this->executer($sql, [
            'id' => $id
        ]);

        $equipe = $requete->fetch(PDO::FETCH_ASSOC);

        return $equipe ?: null;
    }


    public function obtenirJoueursEquipe(int $idEquipe): array
    {
        $sql = "
            SELECT
                idJoueurs,
                nom,
                prénom,
                numero,
                division,
                age,
                sexe,
                idEquipe
            FROM Joueurs
            WHERE idEquipe = :idEquipe
            ORDER BY nom
        ";

        $requete = $this->executer($sql, [
            'idEquipe' => $idEquipe
        ]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ajouterJoueur(
        string $nom,
        string $prenom,
        int $numero,
        int $division,
        int $age,
        string $sexe,
        int $idEquipe
    ): void {

        $sql = "
            INSERT INTO Joueurs
            (
                nom,
                prénom,
                numero,
                division,
                age,
                sexe,
                idEquipe
            )
            VALUES
            (
                :nom,
                :prenom,
                :numero,
                :division,
                :age,
                :sexe,
                :idEquipe
            )
        ";

        $this->executer($sql, [
            'nom' => $nom,
            'prenom' => $prenom,
            'numero' => $numero,
            'division' => $division,
            'age' => $age,
            'sexe' => $sexe,
            'idEquipe' => $idEquipe
        ]);
    }
}