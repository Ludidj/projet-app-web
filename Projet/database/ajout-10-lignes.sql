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