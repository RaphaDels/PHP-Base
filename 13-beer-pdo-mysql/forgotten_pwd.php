<?php
    //Inclure le fichier config/database.php  
    //Inclure le fichier partials/header.php 
    require('partials/header.php'); 
    require_once 'vendor/autoload.php';
?>


<!-- Le contenu de la page d'accueil -->
<div class="container pt-5">
    <h1>Demande de réinitialisation du mot de passe</h1>


<?php 
    //Vérification des erreurs
    if (!empty($_POST)) {
        $email = $_POST['email'];

        //vérifier si l'email existe dans la bdd    
        $query = $db->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $emailExists = (bool) $query->fetchColumn();
        //fetchColumn compte le nombre de lignes exxistante : renvoie 0 si inexistant, 1 si dans la bdd (renvoie 2 si doublon) sous forme de string. si on ajoute (bool) on le force a être un booléen 
        //var_dump($emailExists);
        if ($emailExists) {
            //Récupère le user
            $user = $db->query('SELECT * FROM user WHERE email = "'.$email.'"')->fetch();
            var_dump('toto');
            //Permet de générer une URL complète vers le projet
            $baseUrl = 'http://localhost'.dirname($_SERVER['REQUEST_URI']);
            $token = hash('sha256', $user['id'].$user['password'].$user['created_at']);
            $link = $baseUrl.'/reset_pwd.php?token='.$token.'&id='.$user['id'];

            
            $password = include 'password.php';
            //ci-dessous = contenu de index.php dans dossier 18-composer + le require_once en haut de la page 
                // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587))
            ->setUsername('webforcelille2@gmail.com')
            ->setPassword($password)
            ->setEncryption('tls')
            ;
            $mailer = new Swift_Mailer($transport);
                // Create a message
            $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'Beer Lovers'])
            ->setTo(['raphaeledelsemme@gmail.com'])
            ->setBody('Réinitialisez votre mot de passe en suivant ce lien : '.$link)
            ;
                // Send the message
            $result = $mailer->send($message);
        }  
        //Matthieu conseille de ne pas envoyer de message d'erreur si l'adresse n'est pas en bdd 
    }
?>

    <div class="row pt-3">
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email">
            </div>
            <button type="submit" class="btn btn-dark">Envoyer</button>
        </form>
    </div>
</div>


<?php
    
    /* ENVOI D'UN MAIL
    La fonction mail() de php ne fonctionne pas en local
    3 paramètres : $to, $subject, $message

    Ne fonctionne pas en local car seulement xampp (http), pas de serveur smtp (pour envoi des mails)
    Il faut reconfigurer pour passer par GMAIL
        dans php.ini -> cherche "mail function" (ligne 1049) -> décommenter et modifier :
            sendmail_from = me@example.com => = webforcelille2@gmail.com
            sendmail_path = ":\xampp\sendmail\sendmail.exe -t -i"
        Au-dessus remplacer smtp_port=25 par smtp_port=587
                            SMTP=localhost par SMTP=smtp.gmail.com

        Dans xampp > sendmail > sendmail.ini
        remplacer smtp_port=25 par =587
        remplacer smtp_server=mail.mydomain.com par smtp_server=smtp.gmail.com
        auth_username=webforcelille2@gmail.com
        auth_password=W3bforce
        force_sender=webforcelille2@gmail.com
        +redémarrer Apache

    SINON
    Installer Mail catcher

    OU installer une bibliothèque ex : PHP MAILER ou SWIFT MAILER (utilisée par Symfony)
    COMPOSER est un gestionnaire de dépendances (dependency manager) qui permet de mettre à jour facilement les librairies, s'assurer que tout le monde utilise la même version, 


    COMPOSER (voir slides Matthieu php)
        télécharger (https://getcomposer.org/doc/00-intro.md#installation-windows)
        Se gère en CLI dans commander (sur nouvelle fenetre) taper composer
        créer nouveau dossier : λ mkdir 18-composer
        λ composer init
        packge name : webforce/composer
        description => rien + enter
        Author : 
        Minimum stability => rien + enter
        Package type => rien + enter
        License => rien + enter
        question 1 => no
        question 2 => non
        => Recap'
        do you confirm generation => yes
        λ ls

        sur packagist.org, installer swiftmailer/swiftmailer
        Dans le dossier du projet (18-composer)
            c:\xampp\htdocs\PHP-Base\18-composer (raphaele -> origin)
            λ composer require swiftmailer/swiftmailer
        λ ls 
        => nous indique : composer.json et composer.lock

        Dans le dossier 18-composer, le dossier vendor est très lourd => ne pas le commiter sur git (inutile)
        => pour cela, à la racine de PHP-Base, créer un fichier .gitignore dans lequel on écrit seulement : vendor
        Chez nous, on fait un pull, mais il manquera le dossier vendor donc : 
        λ composer install => il va recréer lui-même le dossier vendor


        Semantic versioning : 2.1.3 
        2 = màj majeure (casse le code); 1 = màj mineure; 3 = patch

        dasn 18-composer > créer index.php et copier/coller le code sur 
        https://swiftmailer.symfony.com/docs/introduction.html > Basic usage 
        et modifier le require_once, l'adresse, le mdp
        on laisse le setFrom mais on change le setTo 

        ...

    */


    //Inclure le fichier partials/footer.php 
    require('partials/footer.php'); 
?>