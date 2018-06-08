<?php

require_once 'vendor/autoload.php'; //effacer le début de /path/to/vendor/autoload.php

// Create the Transport
$password = include '../13-beer-pdo-mysql/password.php';
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587))
  ->setUsername('webforcelille2@gmail.com')
  ->setPassword($password)
  ->setEncryption('tls')
  /* Si ça ne marche pas, rajouter :
  ->setStreamOptions([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false
    ]
  ])
  */
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['john@doe.com' => 'Beer Lovers'])
  ->setTo(['raphaeledelsemme@gmail.com'])
  ->setBody('Réinitialisez votre mot de passe')
  ;

// Send the message
$result = $mailer->send($message);
