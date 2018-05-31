<?php

//connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=movie_catalog;charset=UTF8', 'root', '', [
    //on récupère tous les résultats en tbl associatif (et pas associatif ET numérique par défaut)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);


//Ecrire une requête qui récupère un film par son id
//l'id doit provenir de l'url. ex : si je saisis movie.php?id=17, la requete doit récupérer le film dont l'id est 17


//je récupère l'id dans l'url grâce à $_GET
$id = $_GET['id'];

//je concatène la variable pour dynamiser la requête
$query = $db->query('SELECT * FROM movie WHERE id =' . $id);

//je récupère un seul film avec fetch()
$movie = $query->fetch();

echo('Le film qui porte l\'id '.$movie['id'] .' est '. $movie['name']);

