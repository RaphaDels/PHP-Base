<?php

//phpinfo();

$people = [
    'Jean',
    'Eric',
    'Jeanne',
    'John'
];

echo $people;   //ne fonctionne pas : on ne peut pas faire un echo d'un array
echo '<br/>';

//pour faire du debug : print_r(); entre les balises <pre> et </pre>
echo '<pre>'; 
print_r($people);
echo '</pre>';

//debug du tableau : 
var_dump($people);

//pour afficher Eric : 
echo $people[1];
echo '<br/>';

echo '-----------------foreach----------------';
echo '<br/>';
//parcourir un tableau avec foreach()

foreach ($people as $index => $person) {
    //var_dump($person);
    echo $index . ' : ' . $person . '<br/>';
}

echo '-----------------fin du foreach----------------';

//Attention!! Si un index est déclaré, les éléments suivants vont être auto-incrémentés par rapport à celui-là
$people = [
    'Jean',
    3 => 'Eric',
    'Jeanne'
];

var_dump($people);

//Stocker des contacts dans ce tbl avec les index nom (string), prénom (string), age (int), téléphone (array => portable (string) et fixe (string)). Il peut y avoir plusieurs contacts. 

$people = [
    [
        'lastname' => 'Durst',
        'firstname' => 'Fred',
        'age' => 39,
        'phone' => [
            'mobile' => '+33 (0)6.00.00.00.11',
            'home' => '+33 (0)3 20 00 00 11'],
    ],  [
        'lastname' => 'Davis',
        'firstname' => 'Jonathan',
        'age' => 40,
        'phone' => [
            'mobile' => '+33 (0)6.00.00.00.22',
            'home' => '+33 (0)3 20 00 00 22'],
        ],
    ];
    // => il y 3 niveaux dans ce tableau

var_dump($people);
echo '<br/>';

//Ecrire la boucle foreach qui affiche le prenom, l'age et les numéros de téléphone

foreach ($people as $person) {
    echo $person['firstname'] .' a '. $person['age'] .' ans et est joignable au '. $person['phone']['mobile'] .' ou au '. $person['phone']['home'] .'.<br/>';
    //on peut aussi parcourir tous les téléphones avec un 2e foreach :
    foreach ($person['phone'] as $type => $number) {
        echo $type .' : '. $number . ' - ';
    }
    echo '<br/>';
}


