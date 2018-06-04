<?php
// Configuration de PDO pour la base de données
// On utilise la notation en absolue pour se repérer
require(__DIR__.'/../config/database.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Le menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="img/logo.png" alt="Beer PDO">
                Beer PDO
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                // Permet de récupérer le nom de la page sur laquelle on se trouve
                $page = basename($_SERVER['REQUEST_URI'], '.php'); ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($page == 'index') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'beer_list') ? 'active' : '' ?>">
                        <a class="nav-link" href="beer_list.php">Les Bières</a>
                    </li>
                    <li class="nav-item <?php echo ($page == 'beer_add') ? 'active' : '' ?>">
                        <a class="nav-link" href="beer_add.php">Ajouter une bière</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php // var_dump(basename($_SERVER['REQUEST_URI'], '.php')); ?>
