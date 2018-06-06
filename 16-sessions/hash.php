<?php

/*
LES MOTS DE PASSE

On ne conserve jamais les mdp en clair dans une bdd => il faut les hasher.

On ne doit pas pouvoir récupérer les mdp !!

NE PAS UTILISER md5 OU sha1 QUI NE SONT PAS ASSEZ FIABLES
Le code généré reste le même, on peut donc deviner la valeur inverse

sha126 et sha512 ont le même fonctionnement donc ils seront eux aussi bientôt décryptés. 

*/

//Pour nos mdp on préférera :

$password = 'test';
$hash = password_hash($password, PASSWORD_DEFAULT);
var_dump($hash);

//pour vérifier le hash

var_dump(password_verify('test', $hash)); // retourne true

//le code généré est aléatoire, il est donc impossible de revenir en arrière