<?php

declare(strict_types=1);

class Joueur extends Modele
{
    /*
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
                sexe
            FROM Joueurs
            WHERE idEquipe = :idEquipe
            ORDER BY nom, prénom
        ";

        $requete = $this->executer($sql, [
            'idEquipe' => $idEquipe
        ]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    */


    public function obtenirJoueur(int $idJoueur): ?array
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
            WHERE idJoueurs = :idJoueur
        ";

        $requete = $this->executer($sql, [
            'idJoueur' => $idJoueur
        ]);

        $joueur = $requete->fetch(PDO::FETCH_ASSOC);

        return $joueur ?: null;
    }


    public function supprimerJoueur(int $idJoueur): void
    {
        $sql = "
            DELETE FROM Joueurs
            WHERE idJoueurs = :idJoueur
        ";

        $this->executer($sql, [
            'idJoueur' => $idJoueur
        ]);
    }
    
public function modifierJoueur(
    int $idJoueur,
    string $nom,
    string $prenom,
    int $numero,
    int $division,
    int $age,
    string $sexe
): void {
    $sql = "
        UPDATE Joueurs
        SET
            nom = :nom,
            prénom = :prenom,
            numero = :numero,
            division = :division,
            age = :age,
            sexe = :sexe
        WHERE idJoueurs = :idJoueur
    ";

    $this->executer($sql, [
        'nom' => $nom,
        'prenom' => $prenom,
        'numero' => $numero,
        'division' => $division,
        'age' => $age,
        'sexe' => $sexe,
        'idJoueur' => $idJoueur
    ]);
}


}