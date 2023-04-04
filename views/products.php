<?php use Pdlt\Repository\ProductRepository; ?>
<main class="products">
    <h1>Découvrez nos produits</h1>

            <div id="category">

                <?php
                foreach ($categories as $oCategory) {
                    $bSelected = ($_SESSION['criterias']['category'] ?? '') == $oCategory->getId();
                    echo '<a href="?page='. PAGE_AJAX_PRODUCTS .'&category='.$oCategory->getId().'">'.
                        $oCategory->getName() .
                        '</a>';
                }
                ?>
                <?= '<a data-reset="all" href="?page='. PAGE_AJAX_PRODUCTS .'">Voir tout</a>'; ?>



            </div>

    <div class="products" id="container-ajax" data-context="<?= PAGE_PRODUCTS ?>">

        <?php

        $products = ProductRepository::findAll();
//        $nb_results = count($products);

        foreach ($products as $oProduct) : ?>

            <h3><?= $oProduct->getName(); ?></h3>
            <div class="description">
                <h4>Description</h4>
                <p><?= mb_substr($oProduct->getDescription(), 0, 100); ?></p>
            </div>
            <div class="composition">
                <h4>Composition</h4>
                <p><?= mb_substr($oProduct->getIngredients(), 0, 100); ?></p>
            </div>

        <?php  endforeach; ?>

    </div>

</main>

<script src="js/ajax.js"></script>