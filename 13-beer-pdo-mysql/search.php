<?php

    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 


    if (isset($_GET['q'])) {
        $search = $_GET['q'];

        $query = $db->prepare("SELECT * FROM beer WHERE `name` like :search");
        $query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
        $query->execute();
        $beers = $query->fetchAll();
    
        if (count($beers) > 0) {
            ?>
            <div class="container pt-5">
                <h1>Résultat de votre recherche pour : <?php echo $search; ?></h1>    
                <div class="row pt-3">
                    <?php
                        getBeerList($beers);        
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo 'Aucun résultat';
        }
    }   


//Inclure le fichier partials/footer.php 
    require('partials/footer.php');
?>