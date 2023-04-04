<?php
// Chargement automatique des classes
//spl_autoload_register(function (string $sClass)
//{
//    // Callback
//    // print_r('SPL4' . $sClass);
//
//    // Decomposition des étapes suivantes :
//    // Pour l'instant, on a  $sClass = Blog\Model\ProductCategory par exemple
//    // Ca va nous donner $sClass = src/Model/ProductCategory.php
//
//    $sFilePath = str_replace(['\\','Blog/'], ['/','src/'], $sClass) . '.php';
//    // echo $sFilePath;
//    if(file_exists($sFilePath)) {
//        require_once $sFilePath;
//    };
//});

// Chargement de l'autoload de Composer
// remplace spl_autoload:
// va charger la librairie composer:
require 'vendor/autoload.php';
// Toutes les librairies seront accessibles en auto.

//On indique à PHP que l'on veut utiliser le concept des sessions
session_start();

require_once 'lib/config.php';
//require_once 'lib/functions.php';

// REQUETE TEST
// Initialiser une requête SQL
//$oPdoStatement = $oPdo->query(
//        'SELECT *
//        FROM user'
//);

// AFFICHAGES TESTS
//$nbUsers = $oPdoStatement->rowCount();
//echo 'Nb Users = ';
//print_r($nbUsers);
// On récupère le 1er résultat, affiche un tableau associatif simple avec "\PDO::FETCH_ASSOC"
//$aUser1 = $oPdoStatement->fetch(\PDO::FETCH_ASSOC);
//var_dump($aUser1);

// On récupère le 2e résultat, affiche un tableau associatif simple avec "\PDO::FETCH_ASSOC"
//$aUser2 = $oPdoStatement->fetch(\PDO::FETCH_ASSOC);
//var_dump($aUser2);

// On récupère tous les Users
//$aUsers = $oPdoStatement->fetchAll(\PDO::FETCH_ASSOC);
//var_dump($aUsers);

// Tant qu'il y a des résultats, crée un objet
//while ($aUser = $oPdoStatement->fetch()){
//    // On fait des choses ...
//};


//echo 'Tableau des Users = ';
//print_r($aUsers);


// TESTS AFFICHAGE
// Pour éviter d'afficher les erreurs:
// ini_set('display_errors',false);


// Si la session est vide (user pas connecté), on affiche un id unique
if(!isset($_SESSION['id'])){
    // Création des données basiques de session pour la 1ère fois
    $_SESSION['id'] = uniqid();

    // Permet de stocker des messages pendant une durée limitée
    // Exemple : 'Bonjour XXX' une fois l'user connecté
    // ou gestion des erreurs via messages temporaires
    // Exemple : 'Compte déjà existant'
    $_SESSION['flashes'] = [];
};


$sPage = $_GET['page'] ?? PAGE_HOME;
if (!array_key_exists($sPage,ROUTING)){
    $sPage = PAGE_HOME;
};

[$sClass, $sFunction] = explode('::', ROUTING[$sPage]);
echo (new $sClass())->$sFunction();