<?php 

//on veut utiliser les sessions
session_start(); 
//nous donne accès à $_SESSION

var_dump($_SESSION); // -> le tbl est vide la première fois

$countries = ['fr', 'it'];

//j'ajoute les pays dans la session
$_SESSION['countries'] = $countries;
var_dump($_SESSION);


//Chaque utilisateur a sa session
//Elles sont stockées dans C:\xampp\tmp

//On peut les supprimer dans la console > Application > Cookies > http://localhost

//L'expiration de la session se fait au bout de 1440 s (=20min) par défaut => voir dans php.ini > session.gc.maxlife =
