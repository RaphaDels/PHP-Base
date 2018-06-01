<?php

//ATTENTION : je dois bien lier mon header pour avoir accès à database.php
    require('partials/header.php'); 

//je récupère l'id dans l'url grâce à $_GET
$id = $_GET['id'];

//pour protéger mon url, je peux indiquer qu'il ne faut qu'un entier :
//$id = intval($_GET['id']); //pas suffisant ! 

//je lance une requete sur $db (je concatène la variable pour dynamiser la requête)
//$query = $db->query('SELECT * FROM beer WHERE id =' . $id);


//POUR SE PROTEGER CONTRE LES INJONCTIONS SQL : LES REQUETES PREPAREES
$query = $db->prepare('SELECT * FROM beer WHERE id = :id');  // :id est un paramètre (pas de concaténation)
$query->bindValue(':id', $id, PDO::PARAM_INT);  // On s'assure que l'id est bien un entier
$query->execute(); //execute la requete
$beer = $query->fetch();


//Je dois faire une 2e requete sur la table de la marque 
//je peux utiliser $query car le fetch() a fermé la précédente requete
//la prepare() n'est pas obligatoire si la variable ne vient pas d'une entrée utilisateur (une entree utilisateur vient de $_GET et $_POST)
$query = $db->query('SELECT * FROM brand WHERE id = '.$beer['Brand_id']);
$brand = $query->fetch();


//Je fais une 3e requete sur la table du type pour récupérer l'ebc
$query = $db->prepare('SELECT * FROM EBC WHERE id = :id');
$query->bindValue(':id', $beer['EBC_id'], PDO::PARAM_INT);
$query->execute();
$ebc = $query->fetch();

?>


<!-- Le contenu de la page en html -->
<div class="container pt-5">
    <h1><?php echo 'La '.$beer['name']; ?></h1>
    <div class="row">
        <div class="col-sm-6">
            <img class="img-fluid" src="<?php echo $beer['image']; ?>" alt="<?php echo $beer['name']; ?>"/>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Nom : <?php echo $beer['name']; ?></li>
                <li class="list-group-item"> Degrès : <?php echo $beer['degree']; ?>°</li>
                <li class="list-group-item"> Volume : <?php echo $beer['volume'] / 10; ?> cl</li>
                <li class="list-group-item"> Prix : <?php echo $beer['price']; ?> €</li>
                <li class="list-group-item"> Marque : <?php echo $brand['name']; ?></li>
                <li class="list-group-item"> 
                    <?php 
                        $type = null;
                        switch ($ebc['code']) {
                            case 4:
                                $type = 'Blonde';
                            break;
                            case 26:
                                $type = 'Ambrée';
                            break;
                            case 39:
                                $type = 'Brune';
                            break;
                            case 57:
                                $type = 'Stout';
                            break;
                        }
                    ?>
                    Type : <?php echo $type; ?>
                    <span class="d-inline-block" style="background-color: #<?php echo $ebc['color']; ?>; width: 20px; height: 20px"></span>
                </li>
            </ul>
        </div>
    </div>
</div>



<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php');
?>