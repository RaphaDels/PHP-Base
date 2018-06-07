<?php
    
    //Inclure le fichier config/database.php via le fichier partials/header.php 
    require('partials/header.php'); 



    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];  

        //Vérifier que l'email existe en bdd
        $query = $db->prepare('SELECT * FROM user WHERE email = :email');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(); //retourne un tbl avec le user ou false

        //pas besoin de faire un tbl d'erreurs, c'est juste une variable qui renvoie true ou false
        $errors = null;

        if(!$user){  // = si le user n'existe pas (équivaut à if false)
            $errors = 'Le login n\'existe pas';
        }

        //Vérifier si le mdp est correct (ET email valide)
        if ($user && !password_verify($password, $user['password'])) {
            $errors = 'Le mot de passe est incorrect';
        }

        //si le user existe et que le mdp est correct, alors on peut se connecter :
        if (!$errors) {
            //On genère un token qui sera stocké dans le cookie en concaténant l'id, le pwd hashé et l'heure de connexion
            $token = hash('sha256', $user['id'].$user['password'].$user['created_at']);
            
            //Ajout de l'utilisateur dans la session
            unset($user['password']);  //on enlève le mdp hashé par sécurité
            $_SESSION['user'] = $user;
            
            //Si on a coché la case "Remember me" on ajoute 2 COOKIES (on peut les conserver 13 mois maxi)
            if (isset($_POST['rememberMe'])) {
                setcookie('id', $user['id'], time() + 60 * 60 * 24 * 365);
                setcookie('token', $token, time() + 60 * 60 * 24 * 365);
            }
            //il faut mettre time() pour qu'il parte du timestamp actuel + 1 an 

            //Après la connexion, redirection vers la dernière page consultée grâce au HTTP_REFERER qu'on trouve dans var_dump($_SERVER)
            header('Location: '.$_GET['referer']);
            exit();
        }
        var_dump($errors);
    }
?>

<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Se connecter</h1>

    <div class="row pt-3">
        <!-- Le action="" nous permet soit de rediriger vers la dernière page après le login, soit vers la page d'accueil -->
        <form method="POST" action="?referer=<?php echo $_SERVER['HTTP_REFERER'] ?? 'index.php'; ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="mot de passe">
            </div>
            <div class="form-check">
                <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Se rappeler de moi
                </label>
            </div>
            <button type="submit" class="btn btn-dark">Me connecter</button>
        </form>
    </div>
</div>



<?php
    var_dump($_SERVER);

    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>