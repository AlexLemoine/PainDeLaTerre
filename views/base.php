
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

    <link rel="stylesheet" href="assets/css/global.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- font-family: 'Nunito', sans-serif; -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">

    <link rel="icon" type="image/vnd.icon" href="Logo_pain.ico">


    <title>Mon site - <?= $seo_title ??''; ?></title>
</head>

<body>

<?php

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
include 'footer.php';

?>

<?php echo $oDebugbarRenderer->render() ?>

<script src="https://kit.fontawesome.com/f150580969.js" crossorigin="anonymous"></script>
<!--<script src="js/main.js"></script>-->
</body>
</html>