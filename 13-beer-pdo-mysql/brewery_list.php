<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 


    //Requête pour récupérer les brasseries dans la bdd
    $query = $db->query('SELECT * FROM brewery');
    $breweries = $query->fetchAll();
    //var_dump($breweries);
    //$countSQL++;
?>


<div class="container pt-5">
    <h1>Nos brasseries</h1>
    <div class="row pt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Code Postal</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Pays</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($breweries as $brewery) { 
                //$countSQL++; ?>
                <tr>
                    <td><?php echo $brewery['name']; ?></td>
                    <td><?php echo $brewery['address']; ?></td>
                    <td><?php echo $brewery['zip']; ?></td>
                    <td><?php echo $brewery['city']; ?></td>
                    <td><?php echo $brewery['country']; ?></td>
                    <td><?php echo '<a href="brewery_single.php?id='.$brewery['id'].'" class="btn btn-dark d-block m-auto">+</a>'; ?></td>
                    <!-- Le bouton "supprimer la brasserie" doit être visible uniquement si l'utilisateur est connecté (cf. functions.php) -->
                    <td><?php 
                        if (userIsLogged()) {
                            echo '<a href="brewery_delete.php?id='.$brewery['id'].'" class="btn btn-danger d-block m-auto">-</a>'; ?></td>
                    <?php } ?>
                <?php } ?>
                </tr>
            </tbody>
        </table>    
    </div>
</div>

    
<?php
//Inclure le fichier partials/footer.php 
require('partials/footer.php'); 
?>