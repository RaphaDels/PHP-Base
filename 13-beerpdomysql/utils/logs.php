<?php

// Vérifier si le dossier log existe à la racine du projet
// S'il n'existe pas, on doit le créer
$folder = __DIR__.'/../log'; // C:\xampp\htdocs\PHP-Base\13-beerpdomysql\log

if (!is_dir($folder)) {
    mkdir($folder); // On crée le dossier s'il n'existe pas
}

// Logs pour la recherche
if (isset($_GET['query'])) {
    // Définis le fichier de log pour la recherche
    $filename = $folder.'/search.log'; // C:\xampp\htdocs\PHP-Base\13-beerpdomysql\log\search.log

    // On ouvre le fichier (écriture) et on place le curseur à la fin
    $file = fopen($filename, 'a+');

    // On écrit dans le fichier. On ajoute une ligne
    // [Recherche] Un utilisateur a cherché "Duvel" le 05/06/2018 à 11h45
    $query = $_GET['query'];
    $log = '[Recherche] Un utilisateur ('.$_SERVER['REMOTE_ADDR'].') a cherché "'.$query.'" le ' . date('d/m/Y à H\hi') . PHP_EOL; // PHP_EOL équivaut à \r\n ou \n
    fwrite($file, $log);
    fclose($file);
}
