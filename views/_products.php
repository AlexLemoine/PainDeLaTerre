<?php

foreach ($products as $oProduct) : ?>

    <div class="Products-list-card Card">

        <?php if($oProduct->getPicture()): ?>
        <figure class="Card-imgBox">
            <img class="Card-imgBox-img" src="assets/img/<?= $oProduct->getPicture(); ?>"
                 alt="<?= $oProduct->getName(); ?>">
        </figure>
        <?php endif; ?>

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