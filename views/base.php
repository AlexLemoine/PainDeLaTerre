
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
    <!-- font-family: 'Rift', sans-serif; -->
    <link rel="stylesheet" href="https://use.typekit.net/kxn4jzs.css »>
   
    <link rel="icon" type="image/vnd.icon" href="Logo_pain.ico">


    <title>Pain de la Terre - <?= $seo_title ??''; ?></title>
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


<script type="module" src="assets/js/main.js"></script>
<script type="module" src="assets/js/sliderProducts.js"></script>
<script type="module" src="assets/js/products.js"></script>
<script type="module" src="assets/js/functions.js"></script>
<script type="module" src="assets/js/ajax.js"></script>
<script type="module" src="assets/js/admin_ajax.js"></script>
<script type="module" src="assets/js/admin_modify_company.js"></script>
<script type="module" src="assets/js/admin_modify_products.js"></script>



<script src="https://kit.fontawesome.com/f150580969.js" crossorigin="anonymous"></script>

</body>
</html>