<?php
    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 
?>

<!-- LE CONTENU HTML DE LA PAGE -->
<div class="container pt-5">
    <div class="row pt-3">
        <h1>Ajoutez une bière</h1>

        <?php 
        //Je déclare mes variables (vides) et je fais le if qui liste les erreurs avant le formulaire pour qu'en cas d'erreur, les champs saisis correctement restent enregistrés
            $name = null;
            $degree = null; 
            $price = null;
            $volume = null;
            $brand = null;
            $type = null;
            $image = null;

            //Pour détecter quand le formulaire est soumis : soit if(!empty) soit :
            //var_dump($_SERVER);  //-> 'REQUEST_METHOD' => string 'POST' (length=4) -> permet de voir si formulaire GET (il est donc non soumis) ou POST (il est bien soumis)      
            
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
                
                //POUR VERIFIER SI UNE IMAGE A BIEN ETE UPLOADEE
                if (!empty($_FILES['image']['tmp_name'])) { //on vérifie si le nom temporaire est vide ou non (si le nom temporaire est vide c'est qu'on n'a pas téléchargé d'image)
                    $image = $_FILES['image'];
                }
                
                //VERIF DU FORM AVANT ENVOI EN BDD
                //Définir un tableau d'erreurs vide qui va se remplir après chaque erreur
                $errors = [];

                //LISTER ET VERIFIER LES ERREURS POSSIBLES
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
                    //Verifier que le volume saisi fait bien partie des choix possibles du select
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
                        $errors['type'] = 'Ce type de bière n\'existe pas'; 
                    }

                //VERIFICATION DE L'IMAGE UPLOADEE
                    //Vérifier si l'image est bien uploadée
                        if ($image === null) {
                            $errors['image'] = 'Vous n\'avez pas téléchargé d\'image'; 
                        }

                    //Vérifier le type MIME de l'image uploadée avec finfo_file()
                        if ($image) {
                            $file = $image['tmp_name']; //l'emplacement temporaire du fichier uploadé
                            $finfo = finfo_open(FILEINFO_MIME_TYPE); //permet d'ouvrir un fichier
                            $mimeType = finfo_file($finfo, $file); //ouvre le fichier et renvoie  image/img
                            //créer un tbl pour les mime types autorisés : 
                            $allowedExtensions = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                            //vérifier si le mime type obtenu ne figure pas dans ce tbl :
                            if (!in_array($mimeType, $allowedExtensions)) {
                                $errors['image'] = 'Ce type de fichier n\'est pas autorisé';
                            }
                        }

                    //Vérifier la taille de l'image uploadée (2Mo = 2 097 152 octets)
                        if ($image['size'] > 2097152) {
                            $errors['image'] = 'Ce fichier est trop lourd.';
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
                        $query->bindValue(':image', null, PDO::PARAM_STR); //on ajoute la bière d'abord sans image puis on la rajoute une fois l'upload traité (extension, taille...)
                        $query->bindValue(':price', $price, PDO::PARAM_STR);
                        $query->bindValue(':brand_id', $brand_id, PDO::PARAM_INT);
                        $query->bindValue(':ebc_id', $type_id, PDO::PARAM_INT);

                        //Insère la bière dans la bdd en executant la fonction
                        if ($query->execute()) {    
                            //UPLOAD DE L'IMAGE
                            //Récupérer l'emplacement temporaire du fichier
                            $file = $_FILES['image']['tmp_name']; //cf var_dump($_FILES)

                            //Récupérer l'extension du fichier (jpg, jpeg, png, gif, pdf...)
                            $originalName = $_FILES['image']['name'];
                            $extension = pathinfo($originalName)['extension'];
                            //pathinfo => entre () = ce qu'il doit analyser et entre [] = ce qu'on veut récupérer

                            //Générer le nom de l'image (Ch'ti Ambrée doit devenir chti-ambree)
                            //le résultat doit être : marque-nom-de-la-biere.extension
                            $brand = slugify($brand['name']);  //on l'a récupéré avec: $brand = $query->fetch();
                            $name = slugify($name);

                            $filename = $brand.'-'.$name.'.'.$extension;
                            var_dump($filename);

                            //Déposer le fichier dans le dossier img
                            move_uploaded_file($file, __DIR__.'/img/'.$filename);

                            //Requête pour mettre à jour la bière en bdd afin d'associer l'image uploadée
                            $query = $db->prepare('UPDATE beer SET `image` = :image WHERE id = :id');
                            $query->bindValue(':image', 'img/'.$filename, PDO::PARAM_STR);
                            $query->bindValue(':id', $db->lastInsertId(), PDO::PARAM_INT); //on récupère l'id de la dernière bière ajoutée
                            $query->execute();

                            echo '<div class="alert alert-success">La bière a bien été ajoutée !</div>';
                        }   
                    }
            } //end of if(!empty($_POST))    
        ?>
    </div>
    <div class="row pt-3">
        <form method="POST" action="" enctype="multipart/form-data">
            <!-- L'attribut enctype sur le form est obligatoire pour l'upload de fichiers (images, cv...) -->
            <!-- Je fais une boucle pour créer les inputs similaires (champs libres): nom, degrès, prix -->
            <?php
            $fields = ['name' => 'Nom', 'degree' => 'Degrès d\'alcool', 'price' => 'Prix'];
            foreach ($fields as $field => $label) { ?>
                <div class="form-group">
                    <label for="<?php echo $field; ?>"><?php echo $label; ?> : </label>
                    
                    <!-- Je mets le $$field dans value pour qu'il mémorise les champs correctement saisis en cas d'erreur -->
                    <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" id="<?php echo $field; ?>" class="form-control <?php echo isset($errors[$field]) ? 'is-invalid' : null; ?>" placeholder="<?php echo $label; ?>">
                    
                    <?php //pour mettre les champs en rouge en cas d'erreur 
                    if (isset($errors[$field])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors[$field];
                        echo '</div>';
                    } ?>
                </div>
            <?php } ?>
            <div class="form-group">    
                <label for="volume">Volume :</label>
                <select class="form-control" <?php echo isset($errors['volume']) ? 'is-invalid' : null; ?> name="volume" id="volume">
                    <option hidden readonly value="">Choisissez le volume</option>
                    <!-- le if permet de mémoriser la sélection en cas d'erreur sur un autre champ -->
                    <option <?php if ($volume == 250) { echo 'selected'; } ?> value="250">25 cl</option>
                    <option <?php if ($volume == 330) { echo 'selected'; } ?> value="330">33 cl</option>
                    <option <?php if ($volume == 500) { echo 'selected'; } ?> value="500">50 cl</option>
                    <option <?php if ($volume == 750) { echo 'selected'; } ?> value="750">75 cl</option>
                    <option <?php if ($volume == 1000) { echo 'selected'; } ?> value="1000">1 litre</option>
                </select>
                <?php //L'ERREUR NE FONCTIONNE PAS
                if (isset($errors['volume'])) {
                    echo '<div class="invalid-feedback">';
                        echo $errors['volume'];
                    echo '</div>';
                } ?>
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
            <div>
                <label for="image">Télécharger l'image : </label>
                <input type="file" name="image"/>
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark my-2">Ajouter !</button>
            </div>
        </form>
    </div>
    
    <?php 
        //Créer la fonction slugify pour le traitement du nom de l'image (voir plus bas)
        //ex : Ch'ti Ambrée devient : chti-ambree
        function slugify($string) {
            $newString = str_replace(' ', '-', $string);
            $newString = str_replace("'", '', $newString);
            $newString = str_replace(
                array(
                'à', 'â', 'ä', 'á', 'ã', 'å',
                'î', 'ï', 'ì', 'í',
                'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
                'ù', 'û', 'ü', 'ú',
                'é', 'è', 'ê', 'ë',
                'ç', 'ÿ', 'ñ',
                ),
                array(
                'a', 'a', 'a', 'a', 'a', 'a',
                'i', 'i', 'i', 'i',
                'o', 'o', 'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u',
                'e', 'e', 'e', 'e',
                'c', 'y', 'n',
                ),
                $newString
            );
            $newString = mb_strtolower($newString, 'UTF-8');
            return $newString;
        }
        //var_dump(slugify("Ch'ti ambrée"));

            
        //DEBUG DE L'UPLOAD
        var_dump($_FILES);
    ?>
</div>

<?php //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>