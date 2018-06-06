<?php
    //lien avec le header pour avoir accès à database.php
    require('partials/header.php'); 


    $login = null; 
    $email = null;
    $password = null;
    $cfpassword = null;


    // strip_tags   supprime les balises html
    // html_specialchars

    if (!empty($_POST)) {
        //var_dump($_POST);
        $login = str_replace(' ', '', trim(strip_tags($_POST['login'])));
        $email = $_POST['email'];
        $password = trim($_POST['password']);
        $cfpassword = trim($_POST['cfpassword']);

        $errors = [];

        //vérifier que le login n'est pas vide
        if (empty($login)) { 
            $errors['login'] = 'Le login est vide.';
        }
        //vérifier que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide.';
        }
        //vérifier que le password est valide (pas vide est égal à la confirmation)
        if (empty($password) || $password != $cfpassword ) {
            $errors['password'] = 'Les mots de passe sont vides ou ne correspondent pas.';
        }

        //S'il n'y a pas d'erreur
        if (empty($errors)) {
            $query = $db->prepare('INSERT INTO user
            (login, email, password, created_at) VALUES
            (:login, :email, :password, NOW())');                    // NOW() remplace le paramètre :created_at et récupère le datetime
            $query->bindValue(':login', $login, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            //hashage du mdp
            $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR); 
            if ($query->execute()) {  //ajoute l'utilisateur dans la bdd
                echo 'Vous êtes bien inscrit(e)';
            }
        }

        var_dump($login, $email, $password, $cfpassword, $errors);
    }










?>

<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Inscription</h1>
    
    <div class="row pt-3">
        <form method="POST" action="">
        <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="nom">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="email">
                <small id="emailHelp" class="form-text text-muted">Ces données resteront confidentielles</small>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="mot de passe">
            </div>
            <div class="form-group">
                <label for="cfpassword">Confirmation du mot de passe</label>
                <input type="password" name="cfpassword" class="form-control" id="cfpassword" placeholder="confirmation du mot de passe">
            </div>
            <button type="submit" class="btn btn-dark">C'est parti !</button>
        </form>
    </div>
</div>







<?php
    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>