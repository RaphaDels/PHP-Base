<!-- Consigne :
1. Créer un formulaire avec un champ nombre1 et un champ nombre2
2. Au clic sur le bouton "Calculer", faire la somme du nombre1 et nombre2
3. Ajouter un champ radio ou select permettant de choisir l'opération (+, -, *, /)
-->

<form method="POST">
    <label for="nombre1">Nombre 1 : </label>
    <input type="text" id="nombre1" name ="nombre1" placeholder="saisir un nombre"/><br/>
    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select><br/>
    <label for="nombre2">Nombre 2 : </label>
    <input type="text" id="nombre2" name ="nombre2" placeholder="saisir un nombre"/><br/>
    <button>Calculer</button>
</form>

<?php
/*
if(isset($_POST['nombre1']) && isset($_POST['nombre2'])) {
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
}
*/
var_dump($_POST);

if(!empty($_POST)) {  //pour savoir si le formulaire a été soumis 
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $operator = $_POST['operator'];
    $resultat = 0;

    //pour vérifier si nombre1 et nombre2 ne sont pas des nombres valides
    if(!is_numeric($nombre1) || !is_numeric($nombre2)) {
        echo 'Les nombres saisis ne sont pas valides !';
        exit(); //on arrête le script
    }

    //interdire les divisions par zéro
    if($nombre2 == 0 && $operator == '/'){
        echo 'Attention : division par zéro';
    }

    switch($operator) {
        case '+':
            $resultat = $nombre1 + $nombre2;
            break;
        case '-':
            $resultat = $nombre1 - $nombre2;
            break;
        case '*':
            $resultat = $nombre1 * $nombre2;
            break;
        case '/':
            $resultat = $nombre1 / $nombre2;
            break;
    }
    echo $resultat; 
}

/* Fonctions de vérification :
- isset()     détermine si une variable est définie et est différente de NULL
- empty()     détermine si une variable est vide
- strlen      calcule la taille d'une chaîne de caractères
- ctype_digit vérifie qu'une chaîne est un entier
- is_numeric  détermine si une variable est un type numérique. 
- filter_var  filtre une variable avec un filtre spécifique ex: présence du @
*/

