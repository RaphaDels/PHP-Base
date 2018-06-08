<?php

// Inclure le fichier config/database.php
// Inclure le fichier partials/header.php
require('partials/header.php'); ?>

<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Liste des brasseries</h1>

    <img src="http://localhost/PHP-Base/13-beerpdomysql/brewery_delete.php?id=1" alt="">

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>Pays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
            $query = $db->query('SELECT * FROM brewery');
            // Récupére toutes les brasseries
            $breweries = $query->fetchAll();

            foreach ($breweries as $brewery) {
                echo '<tr>';
                    echo '<td>'.$brewery['id'].'</td>';
                    echo '<td>'.$brewery['name'].'</td>';
                    echo '<td>'.$brewery['address'].'</td>';
                    echo '<td>'.$brewery['city'].'</td>';
                    echo '<td>'.$brewery['zip'].'</td>';
                    echo '<td>'.$brewery['country'].'</td>';
                    echo '<td>';
                        echo '<a class="btn btn-info" href="brewery_single.php?id='.$brewery['id'].'">Voir la brasserie</a>';
                        if (userIsLogged()) {
                            echo '<a class="btn btn-danger" href="brewery_delete.php?id='.$brewery['id'].'">Supprimer la brasserie</a>';
                        }
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </table>

</div>

<?php
// Inclure le fichier partials/footer.php
require('partials/footer.php');
