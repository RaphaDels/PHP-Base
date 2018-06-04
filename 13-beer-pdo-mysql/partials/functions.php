<?php
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

?>