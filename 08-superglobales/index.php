<?php

//Les superglobales
//On peut accéder aux données dans l'url grâce à $_GET

var_dump($_GET);

    //avec isset() on vérifie que l'id est bien présent dans l'url sinon on a une notice Undefined 
    if (isset($_GET['id'])) { 
        $id = $_GET['id']; //on récupère l'id dans l'url
        if($id == 5) {
            echo 'Utilisateur 5';
        }
    }


//Récupérer le paramètre name dans l'url (index.php?name=titi)
//et l'afficher sur la page -> Hello titi ! 

    if(isset($_GET['name'])) {
        $name = $_GET['name'];
        echo 'Hello '. $name .' !';
    }


//On a également accès à $_POST 
var_dump($_POST);
?>

<form method="POST">
    <!-- si on ne met pas method="" il envoie sur la page courante, ici index.php -->
    <label for="age">Votre âge : </label>
    <input type="text" id="age" name ="age" placeholder="saisir votre âge"/>
    <!-- c'est l'attribut name qui permet de récupérer en méthode POST  -->
    <button>Envoyer</button> 
    <!-- par défaut le button est en type submit donc pas la peine de préciser -->
</form>

<?php 
