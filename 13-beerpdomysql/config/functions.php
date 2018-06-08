<?php

// Permet de transformer/slugifier un nom
// Exemple : Ch'ti Ambrée -> chti-ambree
function slugify($string) {
    $newString = str_replace(' ', '-', $string);
    $newString = str_replace('\'', '', $newString);
    $newString = str_replace(['à', 'á', 'â', 'ã', 'ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ',
    'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã',
    'Ä','Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ',
    'Ö', 'Ù','Ú','Û','Ü', 'Ý'], ['a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n',
    'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A',
    'C','E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O',
    'U','U','U','U', 'Y'], $newString);
    $newString = strtolower($newString);

    return $newString;
}

// La fonction permet de vérifier si une brasserie existe ou non en BDD (true ou false)
function breweryExists($id) {
    global $db;  // Permet d'utiliser la variable $db définie en dehors de la fonction
    $query = $db->prepare('SELECT * FROM brewery WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $brewery = $query->fetch();
    
    return $brewery; // La fonction retourne un tableau avec la brasserie ou false si la brasserie n'existe pas
}

// Permet de sauvegarder la dernière page que l'utilisateur a visité
function saveLastVisitedPage() {
    if (!isset($_SERVER['HTTP_REFERER'])) {
        return; // On ne fait rien si la clé HTTP_REFERER n'existe pas
    }

    $urlLastPage = $_SERVER['HTTP_REFERER']; // On récupére la dernière page visitée
    $_SESSION['lastPage'] = $urlLastPage;
}
saveLastVisitedPage();

// Renvoie true si quelqu'un est connecté ou false si pas connecté
function userIsLogged() {
    return isset($_SESSION['user']);
}

// Vérifie si un cookie est présent chez l'utilisateur et le connecte automatiquement
function cookieAuthentication() {
    global $db;
    if (isset($_COOKIE['id'])) { // Si un cookie est présent
        $idUser = $_COOKIE['id']; // On récupérer l'id dans le cookie
        $query = $db->query('SELECT * FROM user WHERE id = '.$idUser);
        $user = $query->fetch();

        $token = $_COOKIE['token']; // On vérifie que le cookie avec le token est valide
        if ($token == hash('sha256', $user['id'].$user['password'].$user['created_at'])) {
            unset($user['password']); // On enlève le mot de passe "hashé" par sécurité
            $_SESSION['user'] = $user; // On connecte le visiteur avec l'utilisateur correspondant à l'id dans le cookie
        }
    }
}
cookieAuthentication();
