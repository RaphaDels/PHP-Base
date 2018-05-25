<?php

//Chercher le timestamp de son anniversaire 

echo date('D d/m/Y', strtotime('4 may 1981'));
echo '<br/>';
echo date('l d/m/Y', strtotime('last monday'));
echo '<br/>';
echo date('c'); //affiche la date au format ISO 8601 (UTC) 2018-05-24T16:39:07+02:00
echo '<br/>';



//Ecrire la date d'aujourd'hui, l'heure, et les secondes.

echo date('l j F Y') . ' il est '. date('h\hi') .' et '. date('s') . ' secondes.' ;

echo '<br/>'; 

//Trouver la date qu'il sera dans 10 jours

echo strtotime('+10 days'); //on récupère le timestamp
echo '<br/>';
//on convertit le timestamp en jour avec date()
echo date('l j F Y', 1528096555);