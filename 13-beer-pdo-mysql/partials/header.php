<?php 
//Configuration de PDO pour la base de données
//on utilise la notation absolue (DIR) pour se repérer parce qu'on appelle database.php dans le header.php qui est lui-même appelé dans index.php, beer_list.php...
require(__DIR__.'/../config/database.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">

    <title>Projet Beer PDO</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container">
            <img class="logo" src="img/beer-icon.png"/> 
            <a class="navbar-brand" href="index.php">Beer PDO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">

                <!-- Pour appliquer la classe active à la page affichée (+ dans le <li>) -->
                <?php $page = basename($_SERVER['REQUEST_URI'], '.php'); ?>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($page == 'index') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'beer_list') ? 'active' : '' ?>">
                        <a class="nav-link" href="beer_list.php">Nos bières</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'beer_add') ? 'active' : '' ?>">
                        <a class="nav-link" href="beer_add.php">Ajouter une bière</a>
                    </li>
                </ul>
            </div>
        </div>    
    </nav>
