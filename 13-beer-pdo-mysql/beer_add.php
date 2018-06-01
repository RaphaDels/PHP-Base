<?php

//Inclure le fichier partials/header.php 
    require('partials/header.php'); 

?>


    <!-- Le contenu de la page -->
<div class="container pt-5">
    <div class="row pt-3">
        <h1>Ajoutez une bière</h1>
    </div>

    <?php 
        //Je déclare mes variables (vides) et je fais le if avant le formulaire pour qu'en cas d'erreur, les champs saisis correctement restent enregistrés
        $name = null;
        $degree = null; 
        $price = null;
        $volume = null;
        $brand = null;
        $type = null;

        //Pour détecter quand le formulaire est soumis : soit !empty soit :
        //var_dump($_SERVER);  //// 'REQUEST_METHOD' => string 'POST' (length=4) -> permet de voir si formulaire GET (non soumis) ou POST (soumis)      
        
        if(!empty($_POST)) {  
            $name = $_POST['name'];         //doit faire au moins 3 caractères 
            $degree = $_POST['degree'];     //doit faire entre 0 et 20 degrès
            $price =$_POST['price'];        //doit couter entre 0.01 € et 99.99 € max
            $volume =$_POST['volume'];      //doit faire 250 / 330 / 500 / 750
            $brand = $_POST['brand'];       //doit exister dans la bdd
            $type = $_POST['type'];         //doit exister dans la bdd
            $isValid = true;

            //Raccourci avec l' interpolation de variables 
            // au départ : ${'name'} -> équivaut à : ${$key} -> donc les accolades sont inutiles : $$key
            /*
            foreach ($_POST as $key => $field) {
                $$key = $field;     
            }*/
        }
                
    ?>

    <div class="row pt-3">
        <form method="POST" action="">
            <!-- Je fais une boucle pour créer les inputs similaires (champs libres): nom, degrès, prix -->
            <?php
            $fields = ['name' => 'Nom', 'degree' => 'Degrès d\'alcool', 'price' => 'Prix'];
            foreach ($fields as $field => $label) { ?>
                <div class="form-group">
                    <label for="<?php echo $field; ?>"><?php echo $label; ?> : </label>
                    <!-- Je mets le $$field dans value pour qu'il mémorise les champs correctement saisis en cas d'erreur -->
                    <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" id="<?php echo $name; ?>" class="form-control" placeholder="<?php echo $field; ?>">
                </div>
            <?php } ?>
            <div class="form-group">    
                <label for="volume">Volume :</label>
                <select class="form-control" name="volume" id="volume">
                    <option hidden readonly value="">Choisissez le volume</option>
                    <!-- le if permet de mémoriser la sélection en cas d'erreur sur un autre champ -->
                    <option <?php if ($volume == 250) { echo 'selected'; } ?> value="250">25 cl</option>
                    <option <?php if ($volume == 330) { echo 'selected'; } ?> value="330">33 cl</option>
                    <option <?php if ($volume == 500) { echo 'selected'; } ?> value="500">50 cl</option>
                    <option <?php if ($volume == 750) { echo 'selected'; } ?> value="750">75 cl</option>
                    <option <?php if ($volume == 1000) { echo 'selected'; } ?> value="1000">1 litre</option>
                </select>
            </div>
            <div class="form-group">    
                <label for="brand">Marque : </label>
                <input list="brands" name="brand" class="form-control" type="text" id="brand" value="<?php echo $brand; ?>" placeholder="Choisissez la marque"/>
                <datalist id="brands">
                    <select>
                        <option value="Chimay - 1">Chimay</option>
                        <option value="Duvel - 2">Duvel</option>
                        <option value="Kwak - 3">Kwak</option>
                        <option value="Guinness - 4">Guinness</option>
                        <option value="Ch'ti - 5">Ch'ti</option>

                    </select>
                </datalist>
            </div>
            <div class="form-group">    
                <label for="type">Type de la bière : </label>
                <input list="types" name="type" class="form-control" type="text" id="type" value="<?php echo $type; ?>" placeholder="Choisissez la couleur"/>
                <datalist id="types">
                    <select>
                        <option value="Blonde - 1">Blonde</option>
                        <option value="Ambrée - 2">Ambrée</option>
                        <option value="Brune - 3">Brune</option>
                        <option value="Stout - 4">Stout</option>
                    </select>
                </datalist>
            </div>
            <div class="">
                <button type="submit" class="btn my-2">Ajouter !</button>
            </div>
        </form>
    </div>
    
    <?php 
        
        //Définir un tableau d'erreurs vide qui va se remplir après chaque erreur
            $errors = [];

            //Lister et vérifier les erreurs possibles
            if (strlen($name) < 3) {
                $errors['name'] = 'Le nom n\'est pas valide'; //équivaut à: array_push($errors, 'Le nom n\'est pas valide'); 
                $isValid = false;
            }
            if (!is_numeric($degree) || $degree < 0 || $degree > 20) {
                $errors['degree'] = 'Le degré n\'est pas valide'; 
                $isValid = false;
            }
            if (!is_numeric($price) || $price < 0.01 || $price > 99.99) {
                $errors['price'] = 'Le prix n\'est pas valide'; 
                $isValid = false;
            }
            if (!in_array($volume, [250, 330, 500, 750])) {
                //je crée un tbl avec les valeurs possibles
                // équivaut à ($volume != 250 && $volume != 330 && $volume != 500 && $volume != 750) {
                $errors['volume'] = 'Le volume n\'est pas valide'; 
                $isValid = false;
            }

            //VERIFIER QUE LA MARQUE SAISIE EXISTE 
            $brand_id = intval(substr($brand, -1)); 
            //intval() pour retourner la valeur numérique entière équivalente d'une variable 
            //et substr() pour récupérer le chiffre de "Duvel - 2"
            
            //requete pour aller chercher la marque en bdd
            $query = $db->prepare('SELECT * FROM brand WHERE id = :id');
            $query->bindValue(':id', $brand_id, PDO::PARAM_INT);
            $query->execute();
            $brand = $query->fetch();
            //var_dump($brand);  //renvoie un booleen = true

            if (!$brand) { //-> signifie if false (càd la marque n'existe pas)
                $errors['brand'] = 'Cette marque n\'existe pas'; 
            }

            //VERIFIER QUE LE TYPE SAISI EXISTE 
            $type_id = intval(substr($type, -1));
            
            //Requete pour aller chercher le type
            $query = $db->prepare('SELECT * FROM ebc WHERE id = :id');
            $query->bindValue(':id', $type_id, PDO::PARAM_INT);
            $query->execute();
            $type = $query->fetch();
            //var_dump($type); 
 
            if (!$type) {
                $errors['type'] = 'Ce type n\'existe pas'; 
            }

            var_dump($errors);

            //VERIFIER SI LE TBL D'ERREUR EST VIDE PUIS AJOUTER LA BIERE
            if (empty($errors)) {
                $query = $db->prepare('
                INSERT INTO beer (`name`, degree, volume, `image`, price, brand_id, ebc_id)  
                VALUES (:name, :degree, :volume, :image, :price, :brand_id, :ebc_id)
                ');
                $query->bindValue(':name', $name, PDO::PARAM_STR);
                $query->bindValue(':degree', $degree, PDO::PARAM_STR);
                $query->bindValue(':volume', $volume, PDO::PARAM_INT);
                $query->bindValue(':image', 'img/chimay-chimay-rouge.png', PDO::PARAM_STR);
                $query->bindValue(':price', $price, PDO::PARAM_STR);
                $query->bindValue(':brand_id', $brand_id, PDO::PARAM_INT);
                $query->bindValue(':ebc_id', $type_id, PDO::PARAM_INT);

                //insère la bière dans la bdd en executant la fonction
                if ($query->execute()) {   
                    echo '<div class="alert alert-success">La bière a bien été ajoutée !</div>';
                }
                
            }



    ?>
    

</div>

<?php //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>