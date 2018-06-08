<?php 
//Pour utiliser les sessions, on met session_start tout en haut du code, dans le header pour qu'il soit sur toutes les pages, avant la database.
session_start();    //nous donne accès à $_SESSION


//Configuration de PDO pour la base de données
//on utilise la notation absolue (DIR) pour se repérer parce qu'on appelle database.php dans le header.php qui est lui-même appelé dans index.php, beer_list.php...
require(__DIR__.'/../config/database.php');
//Inclure le fichier avec toutes les fonctions pour pouvoir les utiliser partout 
require(__DIR__.'/../config/functions.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Lien vers style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">

    <title>Projet Beer PDO</title>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container">
            <img class="logo" src="img/beer-icon.png"/> 
            <a class="navbar-brand" href="index.php">Beer L❤️vers</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                <!-- Barre de recherche : action="search.php" vers la page de traitement de la recherche -->
                <form method="GET" action="search.php" class="form-inline mx-auto">
                    <input class="form-control mr-sm-2" type="search" name="q" placeholder="Recherche..." aria-label="Search">
                    <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Chercher !</button>
                </form>
                
                <!-- Pour appliquer la classe active à la page affichée (+ partie dans le <li>) -->
                <?php $page = basename($_SERVER['REQUEST_URI'], '.php'); ?>

                <ul class="navbar-nav ml-auto ">
                    <!--
                    <li class="nav-item <?php // echo ($page == 'index') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    -->
                    <li class="nav-item dropdown <?php echo ($page == 'beer_list' || $page == 'beer_add') ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Bières</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="beer_list.php">Nos bières</a>
                            <a class="dropdown-item" href="beer_add.php">Ajouter une bière</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php echo ($page == 'brewery_list' || $page == 'brewery_add') ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Brasseries</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="brewery_list.php">Nos brasseries</a>
                            <a class="dropdown-item" href="brewery_add.php">Ajouter une brasserie</a>
                        </div>
                    </li>
                    <!-- 
                    Si un utilisateur existe dans la session, on affiche son email et un lien vers logout.php pour se déconnecter.
                    S'il n'y a pas d'utilisateur dans la session on affiche les 2 liens pour s'inscrire et se connecter -->
                    <?php  
                        if (isset($_SESSION['user'])) { ?>
                            <li class="nav-item">
                                <span class="navbar-text text-warning">
                                    <?php echo 'Hello '.$_SESSION['user']['login'].' !'; ?>
                                </span>
                            </li>
                            <li class="nav-item <?php echo ($page == 'logout') ? 'active' : '' ?>">

                                <a class="nav-link" href="logout.php">Se déconnecter <span class="sr-only">(current)</span></a>
                            </li>
                    <?php } else { //si pas d'utilisateur connecté ?> 
                            <li class="nav-item <?php echo ($page == 'register') ? 'active' : '' ?>">
                                <a class="nav-link" href="register.php">S'inscrire <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?php echo ($page == 'login') ? 'active' : '' ?>">
                                <a class="nav-link" href="login.php">Se connecter<span class="sr-only">(current)</span></a>
                            </li>
                    <?php }?>
                </ul>
            </div>
        </div>    
    </nav>
    
    <?php
    