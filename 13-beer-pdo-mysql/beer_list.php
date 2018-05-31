<?php
    //Inclure le fichier config/database.php  


    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 


    //Récupérer la liste des bières
    //Requête 
    $query = $db->query('SELECT * FROM beer');
    //Résultat
    $beers = $query->fetchAll();

    //var_dump($beers);
?>


<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Nos bières !</h1>
    <div class="row">
        <?php
            //On affiche la liste des bières
            foreach ($beers as $beer) { 
                echo '<div class="col-md-3">';
                    echo '<div class="card mb-4">';
                        echo '<img class="beer-img d-block m-auto card-img-top" src="'.$beer['image'].'"/>';
                        echo '<div class="card-body">';
                            echo $beer['name'];
                            //ajouter un bouton (a href) voir la bière. quand on clique on arrive sur la page beer_single.php. Il faudrait que l'url ressemble à beer_single.php?id=IdDeLaBiere
                            echo '<a href="beer_single.php?id='.$beer['id'].'" class="btn btn-dark d-block m-auto">Détails</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            } 
        ?>
    </div>
</div>


<?php

//Inclure le fichier partials/footer.php 

require('partials/footer.php'); ?>