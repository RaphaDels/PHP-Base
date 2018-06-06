<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 


    //Initialiser les variables du formulaire
        $name = null;
        $address = null; 
        $zip = null;
        $city = null;
        $country = null;

    //VERIFIER SI LE FORMULAIRE EST BIEN SOUMIS (DONC REMPLI)
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


        //QUAND LE FORMULAIRE EST VALIDE (LE TBL D'ERREUR EST VIDE) => AJOUTER LA BRASSERIE
        if (empty($errors)) {
            $query = $db->prepare('
            INSERT INTO brewery (`name`, address, zip, city, country)  
            VALUES (:name, :address, :zip, :city, :country)
            '); 
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':address', $address, PDO::PARAM_STR);
            $query->bindValue(':zip', $zip, PDO::PARAM_STR);
            $query->bindValue(':city', $city, PDO::PARAM_STR); 
            $query->bindValue(':country', $country, PDO::PARAM_STR);
           
            //Insère la brasserie dans la bdd en executant la fonction
            if ($query->execute()) {
                echo '<div class="alert alert-success">La brasserie a bien été ajoutée !</div>';
            }
        }
    } //end of if(!empty($_POST))
?>


<div class="container pt-5">
    <h1>Ajoutez une brasserie</h1>

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
                <button type="submit" class="btn btn-dark my-2">Ajouter !</button>
            </div>    
        </form>
    </div>
</div>
    

<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>