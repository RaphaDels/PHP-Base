<?php

// Une constante en PHP est une variable qui ne varie pas.
// Les constantes sont en majuscules par convention.
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'beer_pdo');

// Connexion à la BDD
try { // Essaye le code
    $db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL
    ]);
    // Permettra de compter le nombre de requêtes faites sur la page
    $countSQL = 0;
} catch (Exception $e) { // Si le code renvoie une erreur, fais quelque chose
    echo $e->getMessage(); // On récupére le message de l'exception
    // On peut ouvrir un nouvel onglet qui effectue une recherche sur Google avec l'erreur qu'on a obtenu
    // echo '<script>window.open("http://www.google.fr/search?q='.$e->getMessage().'");</script>';
    echo '<img src="img/confused-travolta.gif" />';
}
