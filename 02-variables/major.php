<?php


$age = 13;

if($age >= 18){
    echo 'Vous pouvez entrer';
} elseif($age >= 16 && $age < 18) {
    echo 'Vous êtes presque majeur, patience...';
} elseif($age >= 14 && $age < 16) {
    echo 'Vous êtes trop jeune';
} else {
    echo 'Vous êtes beaucoup trop jeune, sortez d\'ici !';
}

