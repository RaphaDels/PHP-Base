<?php

// S'il n'y a pas eu de recherche ou qu'elle est vide
if (!isset($_GET['query']) || empty($_GET['query'])) {
    // Redirection vers la liste des bières
    header('Location: beer_list.php');
    exit();
}

// Inclure le fichier config/database.php
// Inclure le fichier partials/header.php
require('partials/header.php'); ?>

<!-- Le contenu de la page -->
<div class="container pt-5">
    <?php
        $query = $_GET['query'];

        echo sprintf('<h1>Résultat de votre recherche pour : %s</h1>', $query);
        // Récupérer la liste des bières qui correspondent au terme de recherche
        $SQLquery = $db->prepare('SELECT * FROM beer WHERE `name` LIKE :query');
        // Le pourcentage signifie n'importe quel caractère
        $SQLquery->bindValue(':query', '%'.$query.'%', PDO::PARAM_STR);
        $SQLquery->execute();
        $beers = $SQLquery->fetchAll();
    ?>

    <div class="row pt-4">
        <?php
        // On affiche la liste des bières
        foreach ($beers as $beer) {
            echo '<div class="col-md-3">';
                echo '<div class="card mb-4 box-shadow">';
                    echo '<img class="beer-img d-block card-img-top" src="'.$beer['image'].'" />';
                    echo '<div class="card-body">';
                        echo '<p class="text-center font-weight-bold">';
                            echo $beer['name'];
                        echo '</p>';
                        // Ajouter un bouton (a href) "Voir la bière"
                        // Quand on clique sur le bouton, on doit se rendre sur la page beer_single.php
                        // Créer la page beer_single.php
                        // Il faudrait que l'URL ressemble à beer_single.php?id=IDDELABIERE
                        echo '<a href="beer_single.php?id='.$beer['id'].'" class="btn btn-primary btn-block">Voir la bière</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        } ?>
    </div>
</div>

<?php
// Inclure le fichier s'occupant des logs
require('utils/logs.php');
// Inclure le fichier partials/footer.php
require('partials/footer.php');
