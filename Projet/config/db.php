DROP DATABASE IF EXISTS demo_webtransac;

CREATE DATABASE demo_webtransac
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE demo_webtransac;

CREATE TABLE messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    contenu TEXT NOT NULL,
    date_cree DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

INSERT INTO messages (titre, contenu, date_cree) VALUES
    ('Bienvenue', 'Cette valeur provient de la base de données.', '2026-08-01 09:00:00'),
    ('PHP et MySQL', 'PDO permet à PHP de communiquer avec MySQL.', '2026-08-02 09:00:00'),
    ('Prochaine étape', 'Une seconde application prendra la forme d''un blogue MVC.', '2026-08-03 09:00:00');

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    resume VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_publie DATETIME NOT NULL
) ;

INSERT INTO articles (titre, resume, contenu, date_publie) VALUES
    ('Découvrir PHP', 'Une première page dynamique.', 'PHP produit le HTML envoyé au navigateur.', '2026-08-04 09:00:00'),
    ('Lire MySQL avec PDO', 'Une connexion centralisée et une requête préparée.', 'PDO permet de lire les articles de façon uniforme.', '2026-08-05 09:00:00'),
    ('Séparer avec MVC', 'Un rôle clair pour chaque fichier.', 'Le modèle lit les données, la vue les affiche et le contrôleur coordonne le tout.', '2026-08-06 09:00:00');