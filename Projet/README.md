Le nom de cette application est sportsManager. C'est une application désigné pour gérer le déroulement des activées sportivifs d'un établissement éducatif, ou les membres des équipes pouront consulter les informations de leurs entrainement et match, et aider l'entraineur à perfectionner l'organisation des équipes dont il est responsable

address local pour ouvrir l'application: http://lo calhost/projet-app-web/

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



------ATELIER 3----------

préparation de ma BD:



1. Démarrer MySQL dans AMPPS.
2
FONCTIONALITÉ COMPLETÉ

-consulter la liste des équpes
-Afficher la liste de joueur d'une équipe

-ajouter un joueur dans une équipe
-supprimer un joueur d'une équipe
routage:
index.php contient les actions comme: 
index.php?action=equipes
index.php?action=equipe&id=1





-------ATELIER 4----------



Le projet est en format POO MVC

- `Modèle/
- `Vues/
- `Routage/
- `Services/

le smodele herite de la classe modele et utilise une connection pdo qui est partagé

# ma BD

1. Créer la base de données MySQL.
2. Importer le script du projet et ajouter la table utilisateur





accueil: accueil
equipes:liste des équipes
equipe/ifjoueur: joueurs d'une équipe
ajouter-joueur/idjoueur: ajoute un joueur
modifier-joueur/idjoueur: modifie un joueur
confirmer-supression/idjoueur: supprimer un joueur
inscription: s'inscrir
connexion: se connecter
deconnexion: se déconnecter
recits: la page récits avec ce qui a ete fait ou pas

## Démarrer l'application

1. Démarrer Apache et MySQL.
2. configurer config.db.
3. Placer le projet a la racine
4.ouvrir avec http://localhost/projet/
```
