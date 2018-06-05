<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 

    //Je déclare mes variables (vides) et je fais le if qui liste les erreurs avant le formulaire pour qu'en cas d'erreur, les champs saisis correctement restent enregistrés
    $name = null;
    $address = null; 
    $zip = null;
    $city = null;
    $country = null;

    //Vérifier si le formulaire est bien rempli
    if(!empty($_POST)) {  
        $name = $_POST['name'];         //doit faire au moins 3 caractères 
        $address = $_POST['address'];   //doit faire au moins 10 caractères
        $zip =$_POST['zip'];            //doit faire de 1 à 5 caractères
        $city =$_POST['city'];          //doit faire au moins 3 caractères
        $country = $_POST['country'];   //select avec Fr Be RU Irlande, All, It
        $isValid = true;



?>


<div class="container pt-5">
    <h1>Ajoutez une brasserie</h1>
</div>

    <div class="row pt-3">
        <form method="POST" action="" enctype="multipart/form-data">
            <!-- Je fais une boucle pour créer les inputs similaires (type text): nom, adresse... -->
            <?php
            $fields = ['name' => 'Nom', 'address' => 'Adresse', 'zip' => 'Code Postal', 'city' => 'Ville'];
            foreach ($fields as $field => $label) { ?>
                <div class="form-group">
                    <label for="<?php echo $field; ?>"><?php echo $label; ?> : </label>
                    <!-- Je mets le $$field dans value pour qu'il mémorise les champs correctement saisis en cas d'erreur -->
                    <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" id="<?php echo $name; ?>" class="form-control  <?php echo isset($errors['name']) ? 'is-invalid' : null; ?>" placeholder="<?php echo $field; ?>">
                </div>
            <?php } ?>
            <div class="form-group">    
                <label for="country">Pays : </label>
                <input list="countries" name="country" class="form-control" type="text" id="country" value="<?php echo $country; ?>" placeholder="Choisissez le pays"/>
                <datalist id="countries">
                    <select>
                        <option value="France - 1">France</option>
                        <option value="Belgique - 2">Belgique</option>
                        <option value="Royaume-Uni - 3">Royaune-Uni</option>
                        <option value="Irlande - 4">Irlande</option>
                        <option value="Allemagne - 5">Allemagne</option>
                        <option value="Italie - 6">Italie</option>
                    </select>
                </datalist>
            </div>    
        </form>
    </div>


    
<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>