-- Commentaire en SQL

-- Pour insérer une catégorie à la fois
INSERT INTO category (`name`) VALUES ('Film de gangsters');
-- Pour insérer plusieurs catégories d'un coup (ne pas oublier le ;)
INSERT INTO category (`name`) VALUES 
('Action'),
('Horreur'),
('Science-fiction'),
('Thriller');

-- Pour récupérer toutes les catégories (càd toutes les colonnes de la table catégories)
SELECT * FROM category;

-- Pour remplacer la catégorie Thriller par la catégorie Documentaire
UPDATE category SET `name` = 'Documentaire' WHERE id = 5;

-- supprimer une catégorie (ATTENTION : si on ne met que ' DELETE FROM category ' on supprime TOUTES les categories !
DELETE FROM category WHERE id = 5;
