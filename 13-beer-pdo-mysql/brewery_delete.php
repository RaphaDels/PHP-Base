<?php
//pour avoir accès à la session, à la bdd et à functions 
    session_start();
    require('config/database.php');
    require('config/functions.php');


/*  Pour supprimer les tables qui ont des relations 
    ex : les brasseries qui sont associées à des marques 
    Dans PHP MyAdmin > structure > Vue relationnelle :
        ON DELETE => mettre CASCADE
        ON UPDATE => mettre NO ACTION
*/

    //Si l'utilisateur n'est pas connecté on l'empêche d'accéder à cette page et d'effacer une brasserie 
    if (!userIsLogged()) {
        header('HTTP/1.1 403 Forbidden');
        echo 'Vous n\'êtes pas autorisé(e) à accéder à cette page !';
        exit();
    }
    //Redirection en html (en simulant 1 seconde d'attente pour l'action)
    //echo '<meta http-equiv="refresh" content="1; url=brewery_list.php">';

    // Attention au CSRF token !!
   
    //Requête pour supprimer une brasserie !!!Ne fonctionne pas sur celles qui ont des marques associées
    $query = $db->prepare('DELETE FROM brewery WHERE id = :id');
    $query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    //Redirection si la requête s'est bien executée
    if ($query->execute()) {
        header('Location: brewery_list.php');
    }




    