Le nom de cette application est sportsManager. C'est une application désigné pour gérer le déroulement des activées sportivifs d'un établissement éducatif, ou les membres des équipes pouront consulter les informations de leurs entrainement et match, et aider l'entraineur à perfectionner l'organisation des équipes dont il est responsable

address local pour ouvrir l'application: http://localhost/projet-app-web/

1.Le slogiciels utilisé sont AMPPS, Apache, PHP et MySQL;

les étape pour recuperer mon projet:

1.On doit cloner le projet en premiere grace à l'adresse recuperé dans github avec un git clone
2.On se dirige  vers le repertoire de notre depot git avec la commande CD

3.Démarrer Appache et MySql avec le toggle dans l'application et on peut ensuite l,ouvrir a partir d'une barre de recherche avec l'addresse




```apache
Alias /projet "C:/Projets/projet"

<Directory "C:/Projets/projet">
    Options -Indexes +FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

4. Démarrer le projet

a.Ouvrire softaculous AMPPS
b.activer appache et mysql avec le bouton
c.ouvrir http://localhost/projet-app-web/ dans le navigateur

aucune compilation nécessaire




//chaître 2 

1.ma base de données préparé: 

USE mydb;
INSERT INTO Equipe (idEquipe, idSport, nom, Division) VALUES
(21, 1, 'Aurores', 1),
(22, 1, 'Tempêtes', 2),
(23, 1, 'Étoiles Rouges', 3),
(24, 2, 'Cobras', 1),
(25, 2, 'Mustangs', 2),
(26, 2, 'Grizzlys', 3),
(27, 3, 'Marins', 1),
(28, 3, 'Albatros', 2),
(29, 3, 'Orques', 3),
(30, 3, 'Avalanches', 1);


SELECT * FROM equipe;

INSERT INTO Sports (idSports, nomSport, description) VALUES
(1, 'Soccer', 'Sport collectif'),
(2, 'Basketball', 'Sport collectif'),
(3, 'Volleyball', 'Sport collectif'); 

-----Voici le code a executer afin d'inserer des données dans ma base
**la table sport et la table équipe paratge une clé étrangère

2.ajouter mes varibales dans la configuration appache

3.fermer et démarrer appache après la modification

4.Lien pour démarrer le projet :  http://localhost/projet/
il se trouve dans (C:/Users/Ludiv/projet-app-web/Projet)

5. configurer mysql dans appache

ajouter le code du numero 