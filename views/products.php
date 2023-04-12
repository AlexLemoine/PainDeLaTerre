<?php use Pdlt\Repository\ProductRepository; ?>
<main class="MainContent Products layout">
    <div class="MainContent-titleWrap">
        <h1 class="MainContent-title">Découvrez nos produits</h1>
    </div>

    <!--  Afficher les filtres catégories -->
    <nav class="Products-filter"  id="category">

        <?php
        foreach ($categories as $oCategory) {
            $bSelected = ($_SESSION['criterias']['category'] ?? '') == $oCategory->getId();
            echo '<a class="Products-filter-link"  href="?page='. PAGE_AJAX_PRODUCTS .'&category='.$oCategory->getId().'">'.
                $oCategory->getName() .
                '</a>';
        }
        ?>
        <?= '<a class="Products-filter-link" data-reset="all" href="?page='. PAGE_AJAX_PRODUCTS .'">Voir tout</a>'; ?>

    </nav>


    <div class="Products-list" id="container-ajax" data-context="<?= PAGE_PRODUCTS ?>">

        <?php

        $products = ProductRepository::findAll();

        foreach ($products as $oProduct) : ?>

            <div class="Products-list-card Card">
                <figure class="Card-imgBox">
                    <img class="Card-imgBox-img" src="assets/img/<?= $oProduct->getPicture(); ?>"
                         alt="<?= $oProduct->getName(); ?>">
                </figure>
                <h2 class="Card-title"><?= $oProduct->getName(); ?></h2>

                <section class="Card-desc">
                    <h3 class="Card-desc_title">Description</h3>
                    <p class="Card-desc_text"><?= $oProduct->getDescription(); ?></p>
                    <button class="Card-desc_button">Voir la Composition</button>
                </section>

                <section class="Card-recipe">
                    <h3 class="Card-recipe_title">Ingrédients</h3>
                    <p class="Card-recipe_text"><?= $oProduct->getIngredients(); ?></p>
                    <button class="Card-recipe_button">Voir la Description</button>
                </section>
            </div>

        <?php  endforeach; ?>

    </div>

</main>

<script src="assets/js/ajax.js"></script>