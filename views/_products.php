<?php

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

<?php endforeach; ?>

