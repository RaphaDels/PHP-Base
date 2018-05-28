<?php

$eleves = [
    [
        'nom' => 'Matthieu',
        'notes' => [10, 8, 16, 20, 17, 0, 15, 2]
    ],
    [
        'nom' => 'Thomas',
        'notes' => [4, 18, 12, 15, 13, 7]
    ],
    [
        'nom' => 'Jean',
        'notes' => [17, 14, 6, 2, 16, 18, 9]
    ],
    [
        'nom' => 'Enzo',
        'notes' => [1, 14, 6, 2, 1, 8, 9]
    ],
];

//1. Afficher la liste de tous les élèves avec leurs notes. 
//ex : Matthieu a eu 10, 8, 16, 20, 17, 16, 15 et 2

    foreach ($eleves as $eleve) {
        echo $eleve['nom'] .' a eu ';
        foreach ($eleve['notes'] as $key => $note) {
            echo $note;
            if($key == count($eleve['notes']) - 2){
                echo ' et ';
            } elseif($key == count($eleve['notes']) - 1) {
                echo '';
            } else {
                echo ', ';
            }
        }  
        echo '<br/>';
    }

//2. Calculer la moyene de Jean. On part de $eleves[2]['notes']

    //je calcule la somme des notes de Jean
    $total_notes = array_sum($eleves[2]['notes']);
    //je cherche le nombre de notes
    $longueur_tbl = count($eleves[2]['notes']);
    //je calcule la moyenne
    $average_jean = $total_notes / $longueur_tbl;
    //j'arrondis à 2 chiffres après la virgule
    echo round(($average_jean), 2) ; 

    echo '<br/>------Autre méthode------<br/>';

    $notesDeJean = $eleves[2]['notes'];
    $totalNotes = 0;

    foreach ($notesDeJean as $note) {
        $totalNotes += $note;
    }

    $moyenne = $totalNotes / count($notesDeJean);
    $moyenne = round($moyenne, 2);
    var_dump($totalNotes);
    var_dump($moyenne);

    echo 'La moyenne de Jean est de '. $moyenne .'/20.<br/>';

    echo '<br/>';

//3. Combien d'élèves ont la moyenne ?
    $countAverage = 0; 

    foreach ($eleves as $eleve) {
        $moyenne = array_sum($eleve['notes']) / count($eleve['notes']);
        $moyenne = round($moyenne, 2);
        if ($moyenne >= 10 ) {
            $countAverage++; 
            echo $eleve['nom'] .' a la moyenne.<br/>';
        } else {
            echo $eleve['nom'] .' n\'a pas la moyenne.<br/>';
        }
    }

    echo 'Nombre d\'élèves ayant la moyenne : '. $countAverage . '<br/>';
    echo '<br/>';

//4. Quel élève a la meilleure note ?
//ex : Thomas a la meilleure note : 19
    $noteMax = 0;

    foreach ($eleves as $eleve){
        foreach ($eleve['notes'] as $note){
            if ($note > $noteMax) {
                $noteMax = $note;
            } 
        }
    }
    var_dump($noteMax);

    foreach ($eleves as $eleve){
        foreach ($eleve['notes'] as $note){
            if ($note === $noteMax) {
                echo $eleve['nom'] .' a la meilleure note : '. $noteMax .'.<br/>' ;
                break; //arrête la boucle quand l'élève a au moins une fois la meilleure note (sinon le echo s'affiche 2 fois).
            } 
        }
    }



//5. Qui a eu au moins un 20 ?
//ex : Personne n'a eu 20. Quelqu'un a eu 20

$noteToCheck = 20;
$noteIsCheck = false;

foreach ($eleves as $eleve){
    foreach ($eleve['notes'] as $note){
        if ($note === $noteToCheck){
            $noteIsCheck = true;
            //break; //arrête le foreach
            break 2; //arrête les 2 foreach
        } 
    }
    var_dump($eleve); //ne s'affiche pas avec le break 2
}

if ($noteIsCheck){
    echo 'Quelqu\'un a eu 20.';
} else {
    echo 'Personne n\'a eu 20.';
}



//6. BONUS : Tri à bulles

//tbl à trier :
$notes = [4, 25, 1, 36, 24];
$i = 0; //compteur i qui va être incrémenté

//On parcourt le tbl et tant que $i est inférieur à la taille du tbl:
while($i < count($notes) -1) {
    //on met -1 parce qu'on commence à zéro
    //on vérifie si la 2e valeur est supérieure à la 1re valeur
    if($notes[$i] > $notes[$i + 1]) {
        $temp = $notes[$i]; //on stocke le 4 dans la variable temporaire
        $notes[$i] = $notes[$i + 1]; //on met le 25 à la place du 4
        $notes[$i + 1] = $temp; //on met le 4 à la place du 25
        $i = 0;
    } else {
        //on incrémente le compteur seulement s'il n'y a pas d'échange
        $i++; 
    }
}
var_dump($notes);

//solution plus simple : le arsort (=array sort)


