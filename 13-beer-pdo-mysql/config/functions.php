<?php

//Fonction pour afficher les bières (utilisée dans beer_list.php et le résultat de search)
    
    function getBeerList($_list){
        foreach ($_list as $beer) { 
            echo '<div class="col-md-3">';
                echo '<div class="card mb-4 box-shadow">';
                    echo '<img class="beer-img d-block card-img-top" src="'.$beer['image'].'"/>';
                    echo '<div class="card-body">';
                        echo '<p class="text-center font-weight-bold">';
                            echo $beer['name'];
                        echo '</p>';
                        //ajouter un bouton (a href) voir la bière. quand on clique on arrive sur la page beer_single.php. Il faudrait que l'url ressemble à beer_single.php?id=IdDeLaBiere
                        echo '<a href="beer_single.php?id='.$beer['id'].'" class="btn btn-dark d-block m-auto">Détails</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }
 

//Fonction SLUGIFY pour le traitement du nom de l'image au download (utilisée dans beer_add.php)
    //ex : Ch'ti Ambrée devient : chti-ambree
    function slugify($string) {
        $newString = str_replace(' ', '-', $string);
        $newString = str_replace("'", '', $newString);
        $newString = str_replace(
            array(
            'à', 'â', 'ä', 'á', 'ã', 'å',
            'î', 'ï', 'ì', 'í',
            'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
            'ù', 'û', 'ü', 'ú',
            'é', 'è', 'ê', 'ë',
            'ç', 'ÿ', 'ñ',
            ),
            array(
            'a', 'a', 'a', 'a', 'a', 'a',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'e', 'e', 'e', 'e',
            'c', 'y', 'n',
            ),
            $newString
        );
        $newString = mb_strtolower($newString, 'UTF-8');
        return $newString;
    }


//Function breweryExists() pour vérifier si une brasserie existe ou non en BDD (true ou false) (utilisée dans brewery_single.php)
    
function breweryExists($id) {
        global $db;         //permet d'utiliser la variable $db définie en dehors de la fonction
        $query = $db->prepare('SELECT * FROM brewery WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $brewery = $query->fetch();
        return $brewery;     //retourne un tbl avec la brasserie ou false si la brasserie n'existe pas
    }



//SAVELASTVISITEDPAGE (pour la redirection après le login) (utilisée dans login.php)
    
    function saveLastVisitedPage() {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return;   //s'il n'y a pas de dernière page visitée -> on ne fait rien
        } 

        $urlLastPage = $_SERVER['HTTP_REFERER'];
        $_SESSION['lastPage'] = $urlLastPage;  
    }
    
    saveLastVisitedPage();
    //var_dump($_SESSION);



//USERISLOGGED. Pour savoir si l'utilisateur est connecté, je vérifie s'il y a une session
/*
    function userIsLogged() {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }
*/  //équivaut à :
    
    function userIsLogged() {
        return isset($_SESSION['user']);
    }


//Vérifie si l'utilisateur a un cookie et le connecte automatiquement (le cookie a été installé en cochant la case Remember me)

    function cookieAuthentication() {
        global $db;                     //on déclare $db en global pour pouvoir l'utiliser hors de la fonction
        if (isset($_COOKIE['id'])) {    //si un cookie est présent sur l'ordi du visiteur
            $idUser = $_COOKIE['id'];   //on récupère l'id dans le cookie
            $query = $db->query('SELECT * FROM user WHERE id = '.$idUser);
            $user = $query->fetch(); 
            
            $token = $_COOKIE['token']; //on vérifie que le cookie avec le token est valide
            if ($token == hash('sha256', $user['id'].$user['password'].$user['created_at'])) {
                unset($user['password']);  //on enlève le mot de passe hashé par sécurité
                $_SESSION['user'] = $user;  //on connecte le visiteur avec l'utilisateur correspondant à l'id dans le cookie
            }
        }
    }
    //On appelle la fonction
    cookieAuthentication();


?>