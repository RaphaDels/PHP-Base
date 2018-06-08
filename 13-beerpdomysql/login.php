<?php
require('partials/header.php'); ?>

<div class="container pt-5">
    <h1>Se connecter</h1>

    <?php
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifie que l'email existe en BDD
            $query = $db->prepare('SELECT * FROM user WHERE email = :email');
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch(); // Retourne un tableau avec le user ou false

            $error = null;
            
            // Si le user n'existe pas en BDD
            if (!$user) {
                $error = 'Le login n\'existe pas.';
            }

            // Est-ce que le mot de passe est correct ?
            if ($user && !password_verify($password, $user['password'])) {
                $error = 'Le mot de passe n\'est pas correct';
            }

            // Si le user existe, on peut se connecter
            if (!$error) {
                // Token qui sera stocké dans le cookie
                $token = hash('sha256', $user['id'].$user['password'].$user['created_at']);

                // Ajout de l'utilisateur dans la session
                unset($user['password']); // On enlève le mot de passe "hashé" par sécurité
                $_SESSION['user'] = $user;

                // Si on a coché la case "Remember me", on ajoute un cookie
                if (isset($_POST['rememberme'])) {
                    setcookie('id', $user['id'], time() + 60 * 60 * 24 * 365);
                    setcookie('token', $token, time() + 60 * 60 * 24 * 365);
                }

                // Après la connexion, on veut rediriger l'utilisateur vers la dernière page sur laquelle il était
                header('Location: '.$_GET['referer']);
                exit();
            }

            var_dump($error);
        }
    ?>
    
    <!-- Le action nous permet soit de rediriger vers la dernière page après le login ou vers la page d'accueil -->
    <form method="POST" action="?referer=<?php echo $_SERVER['HTTP_REFERER'] ?? 'index.php'; ?>">
        <div class="form-group"> 
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
            <label class="form-check-label" for="rememberme">Se rappeler de moi</label>
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
</div>

<?php require('partials/footer.php');
