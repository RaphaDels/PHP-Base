<?php

//Vérifier si le dossier log existe à la racine du projet.
//S'il n'existe pas, on doit le créer 

    $folder = __DIR__.'/../log'; //renvoie à C:\xampp\htdocs\PHP-Base\13-beer-pdo-mysql\log

     //s'il nexiste pas, je crée le dossier $folder avec la fonction php mkdir():
    if(!is_dir($folder)) {
        mkdir($folder); 
    }

    //var_dump($_SERVER);

    //Vérifier s'il y a bien une recherche effectuée
    if (isset($_GET['q'])) { 
        //définir le fichier de log pour la recherche
        $filename = $folder.'/search.log'; 
        //chemin complet: C:\xampp\htdocs\PHP-Base\13-beer-pdo-mysql\log\search.log

        //Ouvrir le fichier 
        $file = fopen($filename, 'a+');


        //On écrit dans le fichier, on ajoute une ligne : [Recherche] Un utilisateur a cherché "Duvel" le 05/06/2018 à 11h45
        //fonction fwrite(ressource, phrase);
        //PHP_EOL (php end of line) équivant à : \r\n (sous Windows) ou \n (sous Linux)
        //$_SERVER['REMOTE_ADDR'] permet de récupérer l'adresse ip du visiteur
        $q = $_GET['q'];
        $log = '[Recherche] Un utilisateur ('.$_SERVER['REMOTE_ADDR'].') a cherché "'.$q.'" le '.date('d/m/Y à H\hi').PHP_EOL; 
        fwrite($file, $log);
        fclose($file); 
    }






    /* FONCTIONS DE TRAITEMENT DES FICHIERS

        fopen();
        fwrite(ressource, phrase);
        fclose();


    Autres  fonctions : 
        fread();           
        file_get_contents('log.txt');   récupère la totalité du fichier log.txt
        file_put_contents();            écrit le contenu mis à jour dans le fichier ouvert
        unlink();                       supprime le fichier

    */