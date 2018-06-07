<?php
    //comme on n'inclut pas le fichier partials/header.php, ne pas oublier le session_start()
    session_start();
    


    //AU LOGOUT : SUPPRIMER LA SESSION

        //session_destroy(); //A éviter car détruit toute la session, même le panier
        
        //Mieux vaut utiliser le unset pour ne détruire que l'utilisateur :
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    


    //ET SUPPRIMER LE COOKIE S'IL EXISTE

    if (isset($_COOKIE['id'])) {
        unset($_COOKIE['id']);
        setcookie('id', '', time() - 3600); //supprime le cookie id sur la machine de l'utilisateur
        unset($_COOKIE['token']);
        setcookie('token', '', time() - 3600); //supprime le cookie token sur la machine de l'utilisateur
    }


    //REDIRIGER VERS L'ACCUEIL
        header('Location: index.php');
        exit();


?>

