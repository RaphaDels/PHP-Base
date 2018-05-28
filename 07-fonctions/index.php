<?php

//Pour créer une fonction en php.
//Le nom de la fonction doit être unique.
//Il peut y avoir des arguments ou non. Attention : ils ne sont accessibles que dans la fonction. Ils peuvent avoir des valeurs par défaut (pas en js). Dans ce cas ils ne sont plus obligatoires.

/*
    function addition($argument1 = 1, $argument2 = 2) { 
        return $argument1 + $argument2;
    }

    //Pour appeler la fonction :
    addition(); 
*/

//La portée des variables
/* 
Une variable créée hors des fonctions a une portée globale. ex: $a
Je ne peux pas l'utiliser dans une fonction (contrairement à js) SAUF si je précise dans la fonction : global $a

Les variables créées dans les fonctions ont une portée locale.

*/


//Ex1 - Créer une fonction calculant le carré d'un nombre

    function calculCarre($a) {
        return $a ** 2;
        //return $a * $a;
    }

    echo calculCarre(4);
    echo '<br/>';


//Ex2 - Créer une fonction calculant l'aire d'un rectangle et une fonction pour celle d'un cercle

    function aireRect($l, $L){
        return $l * $L; 
    }

    echo aireRect(10, 4);
    echo '<br/>';


    function aireCercle($rayon){
        return pow($rayon, 2) * M_PI; 
    }

    //M_PI = fonction équivalente à 3.14
    echo aireCercle(8);
    echo '<br/>';


//Ex3- Créer une fonction calculant le prix TTC d'un prix HT. Nous aurons besoin de 2 paramètres : le prix HT et le taux de TVA.

    function convertHtToTtc($prixHT, $tauxTVA){
        //return $prixHT + ($prixHT * ($tauxTVA/100));
        return $prixHT * (1 + $tauxTVA /100);
    }

    echo convertHtToTtc(100, 20);
    echo '<br/>';


//Ex4 - Ajouter un 3e paramètre à cette fonction permettant de l'utiliser dans les 2 sens (HT vers TTC ou TTC vers HT)

    //false : TTC vers HT et true : HT vers TTC
    function convert($price, $rate, $taxes = true) {
        if($taxes){
            return $price * (1 + $rate /100); //la fonction s'arrête au return
        } 
        return $price / (1 + $rate /100);
    }

    echo convert(10, 20);
    echo '<br/>';

    echo convert(120, 20, false);
    echo '<br/>';
