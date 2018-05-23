<?php

$maVariable = 'Ma variable ';
$monAge = 26; 
$c = 10;
$d = $monAge + $c; //26 + 10 (36)

//PHP_EOL => End Of Line. Permet de faire un retour chariot

echo $maVariable . $d . "<br />";    // affiche Ma variable 36
echo "a"."b" . "<br />";             // affiche ab
echo 1 . 1 . "<br />";               // affiche 11
echo 1 + 1 . "<br />";               // affiche 2

//Interpolation de variables possible grâce aux doubles quotes
echo "$maVariable $d <br/>";        // affiche Ma variable 36


