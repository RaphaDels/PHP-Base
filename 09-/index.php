<?php

/* 
1. Acronyme : créer une fonction qui prend en argument une chaine (ex : World of Warcraft) et qui retourne les initiales de chaque mot en majuscule (ex : WOW).

2. Conjugaison : créer une fonction qui permet de conjuguer un verbe ("chercher" par exemple). Cela doit renvoyer toutes les conjugaisons au présent. 
*/

//1.
    /* 
    La fonction explode(param1, param2) transforme une string en tbl de chaînes 
    le 1er paramètre (obligatoire) est le séparateur : " " / "," / "-" ...
    le 2e paramètre (obligatoire) est la chaine à transformer.  
    le 3e paramètre (facultatif) est la limite. 
    */ 

    function first_letters($sentence) {
        $result = explode(" ", $sentence);
        //var_dump($result);
        $initial = "";
        foreach ($result as $letter) {
            $initial .= $letter[0];
        }
        return $initial;
    }

    $string = 'world of warcraft';
    $string2 = 'petit hippie poilu';
    echo strtoupper(first_letters($string));
    echo '<br/>';
    echo strtoupper(first_letters($string2));
    echo '<br/>';

//2.

    function conjugate($verb){
        $root = substr($verb, 0, -2);   //la racine
        $ending = substr($verb, -2);    //la terminaison
        
        $pronouns = [
            'je' => 'e', 
            'tu' => 'es', 
            'il' => 'e', 
            'nous' => 'ons', 
            'vous' => 'ez', 
            'ils' => 'ent'
        ];

        foreach ($pronouns as $pronoun => $ending) {
            echo $pronoun . ' ' . $root . $ending . '<br/>'; 
        }  
    }

    conjugate('chercher');