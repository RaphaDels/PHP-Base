<?php

    //je vérifie s'il n'y a PAS eu de recherche dans l'input search
    if (!isset($_GET['q']) || empty($_GET['q'])) {
        //dasn ce cas => redirection temporaire (302) vers la liste des bières avec: header('Location: ')
        header('Location: beer_list.php');
        exit();  //pour arrêter le script et ne pas exécuter le code qui suit
    }

    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 


    //if (isset($_GET['q'])) { => plus nécessaire puisque que j'ai fait le if tout en haut.
        $search = $_GET['q']; //je récupère le texte saisi dans l'input name="q" dans une variable

        //Requête pour récupérer la liste des bières qui correspondent au search
        $sqlquery = $db->prepare('SELECT * FROM beer WHERE `name` like :search');
        $sqlquery->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
        $sqlquery->execute();
        $beers = $sqlquery->fetchAll();
        //var_dump($beers);

        //count() -> compte tous les éléments d'un tableau ou quelque chose d'un objet
        if (count($beers) > 0) {
            ?>
            <div class="container pt-5">
                <h1>Résultat de votre recherche pour : <?php echo $search; ?></h1>    
                <div class="row pt-3">
                    <?php
                        //function
                        foreach ($beers as $beer) { 
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
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo '<h1>Aucun résultat correspondant
            </h1>';
        }
    //}   



//Inclure le fichier s'occupant des logs
    require('utils/logs.php');

//Inclure le fichier partials/footer.php 
    require('partials/footer.php');
?>