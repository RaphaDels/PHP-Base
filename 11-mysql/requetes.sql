-- pour récupérer tous les films :
SELECT * FROM movie_catalog.movie;

-- pour filtrer et récupérer tous les films de la catégorie "Films de gangster" (id 1)
SELECT * FROM movie WHERE category_id = 1;

-- pour récupérer tous les films de la catégorie "Films de gangster" sortis avant 1990
SELECT * FROM movie WHERE category_id = 1 AND `date` < '1990-01-01';

-- pour récupérer les films du plus récent au plus vieux (ASC => inversement)
SELECT * FROM movie ORDER BY `date` DESC;

-- pour récupérer les films du plus récent au plus vieux ET par ordre alphabétique (on ne peut pas mettre AND après ORDER BY)
SELECT * FROM movie ORDER BY `date` DESC, `name` ASC;

-- pour récupérer les films en ordre aléatoire
SELECT * FROM movie ORDER BY RAND();

-- pour récupérer les 10 premiers films (les index commencent à zéro)
SELECT * FROM movie LIMIT 0, 10;

-- pour récupérer le film le plus récent
SELECT `name`, `date` FROM movie ORDER BY `date` DESC LIMIT 1;
-- pour récupérer le film le plus ancien
SELECT `name`, `date` FROM movie ORDER BY `date` ASC LIMIT 1;

-- pour récupérer le film le plus récent ET le plus ancien (avec des sous-requètes)
SELECT * FROM movie
WHERE `date` = (SELECT MAX(`date`) as `date` FROM movie)
OR `date` = (SELECT MIN(`date`) as `date` FROM movie);

-- pour compter le nombre de films dans la base
SELECT COUNT(id) FROM movie;

-- pour calculer la moyenne des années de sortie des films
SELECT ROUND(AVG(YEAR(`date`))) as average FROM movie;
