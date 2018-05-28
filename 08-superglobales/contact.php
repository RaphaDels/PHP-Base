<!-- Consigne exercice 
:
1. Créer un formulaire avec 3 champs : email, sujet et message.
2. L'email doit être valide.
3. le sujet ne doit pas être vide.
4. le message doit faire au moins 15 caractères.
-->

<?php

//je déclare les variables dès le début, vides.
$email = null;
$subject = null;
$message = null;

//En mettant le if avant le formulaire, je peux mémoriser ce qui est rentré dans les champs en le renvoyant dans le value des input -> value="<?php echo $email; ...

if(!empty($_POST)) {  //je vérifie si le formulaire est soumis
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    //par défaut le formulaire est valide
    $isValid = true;
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $isValid = false;
        echo 'Merci d\'entrer une adresse email valide <br/>';
    } 
    if (empty($subject)){
        $isValid = false;
        echo 'Le champ "sujet" est obligatoire <br/>';
    } 
    if (strlen($message) <= 15) {
        $isValid = false;
        echo 'Votre message doit contenir au moins 15 caractères <br/>';
    } 
    //Pour mettre un message de remerciement si tout est ok
    if($isValid) {
        echo 'Merci ! Le formulaire a bien été envoyé.';
    }
}

?>

<form method="POST">
    <div>
        <label for="email">Email : </label>
        <input type="text" id="email" name ="email" placeholder="votre email" value="<?php echo $email; ?>"/><br/>
    </div>
    <div>
        <label for="subject">Sujet : </label>
        <input type="text" id="subject" name ="subject" placeholder="sujet de votre message" value="<?php echo $subject; ?>"/><br/>
    </div>
    <div>
        <label for="message">Votre message : </label> <br/>
        <textarea name="message" rows="4" cols="20" placeholder="Votre message"><?php echo $message; ?></textarea>
    </div>
    <button>Soumettre</button>
</form>

