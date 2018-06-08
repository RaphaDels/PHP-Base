<?php
    //Inclure le fichier config/database.php  
    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 


    //Vérifier que l'id et le token correspondent
    if ( empty($_GET['id']) || empty($_GET['token']) || !isValidToken($_GET['token'], $_GET['id']) ) {
        echo 'Le token n\'est pas valide';
        exit(); // On arrête le script PHP
    }


    if (!empty($_POST)) {
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];

        $error = null;

        if(empty($password) || $password != $cfpassword) {
            $query = $db->prepare('UPDATE user SET password = :password WHERE id = :id');
            $query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_INT); 
            if ($query->execute()) {  
                echo 'Le mot de passe a bien été modifié';
            }
        }
    }



?>


<!-- Le contenu de la page d'accueil -->
<div class="container pt-5">
    <h1>Réinitialiser le mot de passe</h1>
</div>


    <form method="POST" action="">
        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="cfpassword">Confirmez le nouveau mot de passe</label>
            <input type="password" name="cfpassword" id="password" class="form-control">
        </div>
        <button class="btn btn-dark">Modifier mon mot de passe</button>
    </form>






<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>