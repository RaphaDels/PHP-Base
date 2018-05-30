<?php
    /* LES INCLUSIONS
    Include et require sont des fonctions

    require('header.php')
        génère une erreur fatale en cas d'erreur (ex fichier manquant)

    include('header.php')
        déclenche un warning en cas d'erreur

        include_once

       */

    include('a.php');  //execute le contenu du fichier a
    echo '<br/>';

    // include('aa.php'); si le fichier n'existe pas, il affiche uin warning mais le reste du code s'execute 

    include('a.php');  //execute une 2e fois le contenu du fichier a
    echo '<br/>';

    include_once('a.php');  //execute le contenu du fichier a SEULEMENT s'il n'a pas déjà été affiché 
    echo '<br/>';

    echo 'Reste du site...';
    //require('b.php'); //si b.php n'existe pas, tout le reste du code ne se lance pas.

    var_dump(__DIR__);
    require(__DIR__.'/b.php');  //-> permet d'avoir une adresse absolue

    //__DIR__   emplacement du répertoire courant sur le serveur
    //__FILE__  emplacement du fichier sur le serveur

 

   