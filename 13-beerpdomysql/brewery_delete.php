<?php
session_start();
require('config/database.php');
require('config/functions.php');
// Si l'utilisateur n'est pas connecté, on l'empêche de supprimer une brasserie
if (!userIsLogged()) {
    header('HTTP/1.1 403 Forbidden');
    echo 'Accès interdit';
    exit();
}
// Redirection en HTML
// echo '<meta http-equiv="refresh" content="2; url=brewery_list.php">';
// Attention au CSRF token
// echo 'DELETE FROM brewery WHERE id = '.$_GET['id'];
// Requête pour supprimer une brasserie
$query = $db->prepare('DELETE FROM brewery WHERE id = :id');
$query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$query->execute();
