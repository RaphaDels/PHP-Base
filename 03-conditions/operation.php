<?php


$a = 15;
$b = 5;
$c = 8;

$resultat1 = $a + $b + $c;
echo $a.' + '.$b.' + '.$c.' = '.$resultat1.'<br/>';
//ou avec l'interpolation
echo "$a"." + $b"." + $c"." = ".$resultat1.'<br/>';

$resultat2 = $a * ($b - $c);
echo "$a"." x ($b"." - $c)"." = ".$resultat2.'<br/>';

if($a > 0){ //on vérifie que $a est supérieur à zéro pour éviter les divisions par zéro
    $resultat3 = ($c - $b) / $a;
    echo "($c"." - $b)"." / $a"." = ".$resultat3.'<br/>';
} else {
    echo $resultat3 = "Division par zéro impossible ! <br/>";
}

if( $resultat1 < 20 || $resultat2 < 20 || $resultat3 < 20 ) {
    echo 'Une des opérations renvoie moins de 20.';
}