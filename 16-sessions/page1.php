<?php
session_start(); // On veut utiliser les sessions sur la page

var_dump($_SESSION); // Le tableau est vide la 1ère fois
$countries = ['fr', 'it'];

// J'ajoute les pays dans la session
$_SESSION['countries'] = $countries;
var_dump($_SESSION); // La session doit contenir les pays
