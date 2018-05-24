<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercices sur les boucles</title>
</head>
<body>

<p><strong>Exercice 1</strong> - Ecrire une boucle qui affiche les nombres de 10 à 1.</p>
    <?php        
        for($i = 10; $i > 0; $i--){
            echo $i . ' , '; 
        }
    ?>
<p><strong>Exercice 2</strong> - Ecrire une boucle qui affiche uniquement les nombres pairs entre 0 et 100.</p>
    <?php
        for($j = 1; $j <=100; $j++){
            if($j % 2 === 0 ){
                echo $j . ' , ';
            }
        }
    ?>
<p><strong>Exercice 3</strong> - Ecrire le code permettant de trouver le PGCD (plus grand commun diviseur) de 2 nombres.</p>
    <?php
        $nombre1 = 845;
        $nombre2 = 312;
        $reste = null;      
        $pgcd = null;   
        // le var_dump peut nous aider à comprendre le résultat d'une comparaison
        var_dump(null != 0);
        
        echo 'Le pgcd de '. $nombre1 .' et '. $nombre2 .' est : ';

        /* ex d'algorithme
        845 % 312 = 221;
        312 % 221 = 91;
        221 % 91 = 39;
        91 % 39 = 13;
        39 % 13 = 0;
        */
        // Tant que le reste est strictement différent de 0
        // nombrePlusGrand % nombrePlusPetit

        $dividend = $nombre1;
        $divisor = $nombre2;
        while ($reste !== 0) {
            $pgcd = $divisor;               //= le pgcd potentiel
            $reste = $dividend % $divisor;  //845 % 312 = 221
            $dividend = $divisor;           //845 devient 312
            $divisor = $reste;              //312 devient 221 (312 % 221 = 91)
            if ($reste == 0){
                echo $pgcd;
            }
        }
        

    ?>
<p><strong>Exercice 4</strong> - Coder le jeu du FizzBuzz :
    <ol>
        <li>parcourir les nombres de 0 à 100,</li>
        <li>quand le nombre est un multiple de 3, afficher Fizz,</li>
        <li>quand le nombre est un multiple de 5, afficher Buzz,</li>
        <li>quand le nombre est un multiple de 15, afficher FizzBuzz,</li>
        <li>sinon afficher le nombre.</li>
    </ol>
</p>
    <?php
        for($k=1 ; $k <= 100 ; $k++){
            if($k % 3 === 0 && $k % 5 != 0 ){
                echo 'Fizz'.'<br/>';
            } elseif($k % 5 === 0 && $k % 3 != 0 ){
                echo 'Buzz'.'<br/>';
            } elseif($k % 3 === 0 && $k % 5 === 0){ //ou ($k % 15 === 0)
                echo 'FizzBuzz'.'<br/>';
            } else {
                echo $k .'<br/>';
            }
        }

    ?>


</body>
</html>

