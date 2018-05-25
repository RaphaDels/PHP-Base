<?php

//phpinfo();

$people = [
    'Jean',
    'Eric',
    'Jeanne'
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

//Attention!! Si un index est déclaré, les éléments suivants vont être auto-incrémentés par rapport à celui-là
$people = [
    'Jean',
    3 => 'Eric',
    'Jeanne'
];

var_dump($people);

//stocker des contacts dans ce tbl avec les index nom (string), prénom (string), age (int), téléphone (array => portable (string) et fixe (string)). Il peut y avoir plusieurs contacts. 

$people = [
    [
        'lastname' => 'Delsemme',
        'firstname' => 'Raphaele',
        'age' => 37,
        'phone' => [
            'mobile' => '+33 (0)6.95.29.39.67',
            'home' => '+33 (0)3 20 56 15 47'],
    ],  [
        'lastname' => 'Davis',
        'firstname' => 'Jonathan',
        'age' => 40,
        'phone' => [
            'mobile' => '+33 (0)6.95.29.39.67',
            'home' => '+33 (0)3 20 56 15 47'],
        ],
    ];


var_dump($people);