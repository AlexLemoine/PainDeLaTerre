<?php

// Chargement de l'autoload de Composer
// va charger la librairie composer:
require 'vendor/autoload.php';
// Toutes les librairies seront accessibles en auto.

//On indique à PHP que l'on veut utiliser le concept des sessions
session_start();

require_once 'lib/config.php';

// Si la session est vide (user pas connecté), on affiche un id unique
if(!isset($_SESSION['id'])){
    // Création des données basiques de session pour la 1ère fois
    $_SESSION['id'] = uniqid();

    // Permet de stocker des messages pendant une durée limitée
    $_SESSION['flashes'] = [];
};


$sPage = $_GET['page'] ?? PAGE_HOME;
if (!array_key_exists($sPage,ROUTING)){
    $sPage = PAGE_HOME;
};

[$sClass, $sFunction] = explode('::', ROUTING[$sPage]);
echo (new $sClass())->$sFunction();

