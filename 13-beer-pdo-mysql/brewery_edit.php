<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 


    //Je vérifie si un id existe dans l'url et si la brasserie existe en bdd ? (fonction breweryExists déplacée dasn functions.php)
    
    if(empty($_GET['id']) || !$brewery = breweryExists($_GET['id'])) {  //je définis la variable dans le if (!!! c'est une assignation, pas une comparaison)
        //permet de renvoyer une 404 si la brasserie n'existe pas 
        header('HTTP/1.0 404 Not Found');
        //la 404 personnalisée
        echo '<div class="container text-center mt-5"><h1>404</h1></div>'; 
        require('partials/footer.php');
        exit; //on arrête le script pour ne pas executer inutilement ce qui suit
    }


    //Pour avoir les champs pré-remplis :
        $name = $brewery['name'];
        $address = $brewery['address']; 
        $zip = $brewery['zip'];
        $city = $brewery['city'];;
        $country = $brewery['country'];;


    //LES VERIFICATIONS SONT LES MEMES QUE POUR UN AJOUT
    if(!empty($_POST)) {  
        $name = $_POST['name'];         //doit faire au moins 3 caractères 
        $address = $_POST['address'];   //doit faire au moins 10 caractères
        $zip =$_POST['zip'];            //doit faire de 1 à 5 caractères
        $city =$_POST['city'];          //doit faire au moins 3 caractères
        $country = $_POST['country'];   //select avec Fr, Be, RU, Irl, All, It
        
        $errors = [];   

        //Lister et vérifier les erreurs possibles
        if (strlen($name) < 3) {
            $errors['name'] = 'Le nom n\'est pas valide'; 
            //équivaut à: array_push($errors, 'Le nom n\'est pas valide'); 
        }
        if (strlen($address) < 10) {
            $errors['address'] = 'L\'adresse n\'est pas valide';  
        }
        if (strlen($zip) < 1 || strlen($zip) > 5) {
            $errors['zip'] = 'Le code postal n\'est pas valide';  
        }
        if (strlen($city) < 3) {
            $errors['city'] = 'La ville n\'est pas valide';  
        }
        //Verifier que le pays saisi fait bien partie des choix possibles du select
        //je crée un tbl avec les valeurs possibles
        $allowedCountries = ['France', 'Belgique', 'Royaume-Uni', 'Irlande', 'Allemagne', 'Italie'];
        if (!in_array($country, $allowedCountries)) {
            $errors['country'] = 'Le pays n\'est pas valide'; 
        }

        //var_dump($errors);

        
        //QUAND LE FORMULAIRE N'EST PAS VALIDE => bloc rouge au dessus du formulaire
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">'; 
            foreach ($errors as $error) {
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }


        //QUAND LE FORMULAIRE EST VALIDE (LE TBL D'ERREUR EST VIDE) => METTRE A JOUR LA BRASSERIE
        if (empty($errors)) {
            $query = $db->prepare('             
            UPDATE brewery 
            SET `name` = :name, address = :address, zip = :zip, city = :city, country = :country  
            WHERE id = :id
            '); 
            //Ne pas oublier la condition avec WHERE !
            $query->bindValue(':id', $brewery['id'], PDO::PARAM_INT);
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':address', $address, PDO::PARAM_STR);
            $query->bindValue(':zip', $zip, PDO::PARAM_STR);
            $query->bindValue(':city', $city, PDO::PARAM_STR); 
            $query->bindValue(':country', $country, PDO::PARAM_STR);
           
            //Insère les modifications dans la bdd en executant la fonction
            if ($query->execute()) {
                echo '<div class="alert alert-success">La brasserie a bien été modifiée !</div>';
            }
        }
    } //end of if(!empty($_POST))
?>


<div class="container pt-5">
    <h1>Modifier la brasserie<?php echo ' '.$brewery['name']; ?></h1>

    <div class="row pt-3">
        <form method="POST" action="" enctype="multipart/form-data">
            <!-- Je fais une boucle pour créer les inputs similaires (type text): nom, adresse... -->
            <?php 
            $fields = ['name' => 'Nom', 'address' => 'Adresse', 'zip' => 'Code Postal', 'city' => 'Ville'];
            foreach ($fields as $field => $label) { ?>
                <div class="form-group">
                    <label for="<?php echo $field; ?>"><?php echo $label; ?> : </label>
                    
                    <!-- Je mets le $$field dans value pour qu'il mémorise les champs correctement saisis en cas d'erreur -->
                    <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" id="<?php echo $field; ?>" class="form-control  <?php echo isset($errors[$field]) ? 'is-invalid' : null; ?>" placeholder="<?php echo $label; ?>">

                    <?php //pour mettre le message d'erreur en rouge en-dessous du champ concerné
                    if (!empty($errors[$field])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors[$field];
                        echo '</div>';
                    } ?>
                </div>
            <?php }  ?>
            <div class="form-group">    
                <label for="country">Pays : </label>
                <select name="country" id="country" class="form-control <?php echo isset($errors['country']) ? 'is-invalid' : null; ?>">
                    <option></option>
                    <option <?php echo ($country == 'France') ? 'selected': ''; ?>>France</option>
                    <option <?php echo ($country == 'Belgique') ? 'selected': ''; ?>>Belgique</option>
                    <option <?php echo ($country == 'Royaume-Uni') ? 'selected': ''; ?>>Royaume-Uni</option>
                    <option <?php echo ($country == 'Irlande') ? 'selected': ''; ?>>Irlande</option>
                    <option <?php echo ($country == 'Allemagne') ? 'selected': ''; ?>>Allemagne</option>
                    <option <?php echo ($country == 'Italie') ? 'selected': ''; ?>>Italie</option>
                </select>
                <?php //pour mettre le message d'erreur en rouge en-dessous du champ concerné
                    if (!empty($errors['country'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['country'];
                        echo '</div>';
                    } ?>
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark my-2">Modifier !</button>
            </div>    
        </form>
    </div>
</div>
    

<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>