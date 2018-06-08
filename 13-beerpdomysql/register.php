<?php require('partials/header.php');

if (userIsLogged()) { // Si l'utilisateur est connecté, on le redirige vers la home
    header('Location: index.php');
    exit();
}

?>

<div class="container pt-5">
    <h1>Inscription</h1>

    <?php
        if (!empty($_POST)) { // Si on a soumis le formulaire
            $login = str_replace(' ', '', trim(strip_tags($_POST['login']))); // On supprime les balises HTML
            $email = $_POST['email'];
            $password = trim($_POST['password']);
            $cfpassword = trim($_POST['cfpassword']);

            $errors = [];

            if (empty($login)) { // On vérifie que le login n'est pas vide
                $errors['login'] = 'Le login est vide.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // On vérifie que l'email soit valide
                $errors['email'] = 'L\'email n\'est pas valide.';
            }

            // Vérification mot de passe
            if (empty($password) || $password != $cfpassword) {
                $errors['password'] = 'Les mots de passe sont vides ou ne correspondent pas.';
            }

            // Inscription de l'utilisateur
            if (empty($errors)) {
                $query = $db->prepare('INSERT INTO user
                (login, email, password, created_at) VALUES
                (:login, :email, :password, NOW())');
                $query->bindValue(':login', $login, PDO::PARAM_STR);
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
                if ($query->execute()) { // On ajoute l'utilisateur dans la BDD
                    echo 'Vous êtes bien inscrit.';
                }
            }

            var_dump($login, $email, $password, $cfpassword, $errors);
        }
    ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="cfpassword">Confirmer le mot de passe</label>
            <input type="password" name="cfpassword" id="cfpassword" class="form-control">
        </div>
        <button class="btn btn-primary">S'inscrire</button>
    </form>
</div>

<?php require('partials/footer.php');
