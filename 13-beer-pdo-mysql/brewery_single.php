<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 


/*  //MA METHODE (comme pour beer_single.php)
    $id = $_GET['id'];  
    //Requête préparée 
    $query = $db->prepare('SELECT * FROM brewery WHERE id = :id');  // :id est un paramètre (pas de concaténation)
    $query->bindValue(':id', $id, PDO::PARAM_INT);  // On s'assure que l'id est bien un entier
    $query->execute(); 
    $brewery = $query->fetch();
    //var_dump($brewery);
    $countSQL++; //incrémente le nombre de requêtes dans le footer
*/
    //empty() vérifie aussi le isset() -> remplace : if(!isset($_GET['id']) || empty($_GET['id']))

    //Je vérifie si un id existe dans l'url et si la brasserie existe en bdd ? (fonction breweryExists déplacée dasn functions.php)
    $brewery = breweryExists($_GET['id']);
    if(empty($_GET['id']) || !$brewery) {
        //permet de renvoyer une 404 si la brasserie n'existe pas 
        header('HTTP/1.0 404 Not Found');
        //la 404 personnalisée
        echo '<div class="container text-center mt-5"><h1>404</h1></div>'; 
        require('partials/footer.php');
        exit; //on arrête le script pour ne pas executer inutilement ce qui suit
    }
?>


<!-- Le contenu de la page en html -->
<div class="container pt-5">
    <h1>Brasserie<?php echo ' '.$brewery['name']; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Nom : <?php echo $brewery['name']; ?></li>
                <li class="list-group-item"> Adresse : <?php echo $brewery['address']; ?></li>
                <li class="list-group-item"> Code postal : <?php echo $brewery['zip']; ?></li>
                <li class="list-group-item"> Ville : <?php echo $brewery['city']; ?></li>
                <li class="list-group-item"> Pays : <?php echo $brewery['country']; ?></li>
            </ul>
        </div>
    </div>
</div>


    
<?php
//Inclure le fichier partials/footer.php 
require('partials/footer.php'); 
?>