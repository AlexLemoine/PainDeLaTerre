
<?php
// lien avec la librairie DebugBar

use DebugBar\StandardDebugBar;

$oDebugbar = new StandardDebugBar();
$oDebugbarRenderer = $oDebugbar->getJavascriptRenderer('vendor/maximebf/debugbar/src/DebugBar/Resources');

$oDebugbar['messages']->addMessage('hello world!');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php echo $oDebugbarRenderer->renderHead() ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulaire">


    <title>Mon site - <?= $seo_title ??''; ?></title>
</head>

<body>

<?php

// AFFICHAGES POUR DEBUG
// print_r($_GET) . PHP_EOL;        // Données contenues dans l'url
// print_r($_POST) . PHP_EOL;       // Données de formulaire
// print_r($_SERVER) . PHP_EOL;     // Données "serveur" créées par php
// print_r($_COOKIE) . PHP_EOL;     // Données cookies fournies par le navigateur
// print_r($oPdo);
// print_r($aUser1);
// print_r($aUser2);
//echo 'Tableau infos de aUsers = ';
//print_r($aUsers);
// echo 'Tableau infos de Session = ';
//print_r($_SESSION);

// Ajout du script du header
include 'header.php';

// Affichage des msg utilisateurs (flash messages)
foreach ($_SESSION['flashes'] as $iIndice => $aMessages) {
    foreach ($aMessages as $sType => $sMessages) {
        echo '<div class="alert alert-' . $sType . '">' . $sMessages . '</div>';
    };
};
$_SESSION['flashes'] = [];

// ajouter les views dans le body
if(file_exists('views/' . $sView)){
    include $sView;
};

// Ajout du script du footer
//include 'footer.php';

?>

<?php echo $oDebugbarRenderer->render() ?>

<script src="https://kit.fontawesome.com/f150580969.js" crossorigin="anonymous"></script>
<!--<script src="js/main.js"></script>-->
</body>
</html>