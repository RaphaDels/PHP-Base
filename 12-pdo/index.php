<?php
//mysql, host localhost, dbname movie_catalog, user root, pass ''

//créer une connexion à la bdd
    $db = new PDO('mysql:host=localhost;dbname=movie_catalog;charset=UTF8', 'root', '', [
        //on récupère tous les résultats en tbl associatif (et pas associatif ET numérique)
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    var_dump($db);

//créer une requete pour récupérer tous les films
    $query = $db->query('SELECT * FROM movie');
    var_dump($query);

//récupérer un seul résultat
//$movie = $query->fetch();
//var_dump($movie);

//récupérer TOUS les résultats. 
//ATTENTION : Faire un fetch puis un fetchAll fausse le résultat car le fetchAll ne démarre qu'après le premier fetch (donc 21 résultats au lieu de 22)
    $movies = $query->fetchAll();
    var_dump($movies);

//Parcourir la liste des films et afficher leur titre dans une liste
    echo '<ul>';
    foreach ($movies as $movie) {
        echo '<li>'. $movie['name'] .' , '. $movie['date'] .'</li>';
    }
    echo '</ul>';







