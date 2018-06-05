<?php

//Une constante en php est une variable qui ne varie pas. 
//Par convention elles s'écrivent en majuscules et il n'y a pas de $
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'beer_pdo');


//connexion à la bdd (qui est appelé en require dans le header, au-dessus du doctype)
/* 

$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, //permet d'activer les erreurs sql dans pdo 
]);


En cas d'erreur (ex faute d'orthographe dasn le nom de la bdd), pour nous aider à débuguer => TRY CATCH
Signifie "essaie le code ci-dessous" (try) et si erreur "fais ceci" (catch)
*/
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        //permet de compter le nombre de requêtes faites sur la base (cf $countSQL++; dans beer_list.php)
        $countSQL = 0;

    } catch (Exception $e) {
        echo $e->getMessage();  //on récupère le message de l'exception tout en haut de la page, au-dessus du doctype (sauf si navbar fixed). Ici : unknown database
        // on peut ouvrir un nouvel onglet qui fait une recherche avec l'erreur qu'on a obtenu
        echo '<script>window.open("https://stackoverflow.com/'.$e->getMessage().'")</script>';
        echo '<img src="img/confused-travolta.gif" />'; //pour personnaliser ses messages d'erreur ex: travolta de pulp fiction dans Symfony4
    }





