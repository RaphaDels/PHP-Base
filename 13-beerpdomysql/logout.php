<?php
session_start();

// Supprimer la session
// session_destroy(); // Détruit toute la session
// Il vaut mieux seulement détruire l'utilisateur
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

// Supprimer le cookie s'il existe
if (isset($_COOKIE['id'])) {
    unset($_COOKIE['id']);
    setcookie('id', '', time() - 3600); // Supprime le cookie sur la machine de l'utilisateur
    unset($_COOKIE['token']);
    setcookie('token', '', time() - 3600); // Supprime le cookie sur la machine de l'utilisateur
}

// Rediriger vers l'accueil
header('Location: index.php');
exit();
