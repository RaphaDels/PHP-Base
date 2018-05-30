<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css"/>
        <!-- chargement du css de bootstrap -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/main.css"/>
    <title>Exo sur les inclusions</title>
</head>

<body>

<?php
    /* LES INCLUSIONS
    Include et require sont des fonctions

    require('header.php')
        génère une erreur fatale en cas d'erreur (ex fichier manquant)

    include('header.php')
        déclenche un warning en cas d'erreur

        include_once

    include('a.php');  //execute le contenu du fichier a
    echo '<br/>';

    // include('aa.php'); si le fichier n'existe pas, il affiche uin warning mais le reste du code s'execute 

    include('a.php');  //execute une 2e fois le contenu du fichier a
    echo '<br/>';

    include_once('a.php');  //execute le contenu du fichier a SEULEMENT s'il n'a pas déjà été affiché 
    echo '<br/>';

    echo 'Reste du site';
    //require('b.php'); //si b.php n'existe pas, tout le reste du code ne se lance pas.

    var_dump(__DIR__);
    //require(__DIR__.'/b.php');  //-> permet d'avoir une adresse absolue

    //__DIR__   emplacement du répertoire courant sur le serveur
    //__FILE__  emplacement du fichier sur le serveur

    */

    require_once('header.php');
?>

<div class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">Petit jumbotron pour l'exercice.</p>
        <hr class="my-4">
        <p>Bla bla bla bla bla...</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">En savoir plus !</a>
    </div>


<?php
    include('contact.php');
?>


<?php
    require_once('footer.php');
?>

</body>
</html>
