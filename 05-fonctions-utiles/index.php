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

 

//Ecrire la date