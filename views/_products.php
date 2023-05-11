<?php foreach ($products as $oProduct) : ?>

<div class="Products-list-card Card">
	<figure class="Card-imgBox">
		<img id="img1" class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oProduct->getPicture(); ?>"
		     alt="<?= $oProduct->getName(); ?>">
		<img id="img2" class="Card-imgBox-img hidden" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oProduct->getPictureSecondary(); ?>"
		     alt="<?= $oProduct->getName(); ?>">
	</figure>
	<h2 class="Card-title"><?= $oProduct->getName(); ?></h2>

	<section class="Card-desc">
		<p class="Card-desc-text"><?= $oProduct->getDescription(); ?></p>
		<p class="Card-desc-frequency"><?= 'Disponible ' . $oProduct->getFrequency()->getDesignation(); ?></p>
	</section>

	<section class="Card-recipe">
		<h3 class="Card-recipe-title">Ingrédients</h3>
		<p class="Card-recipe-text"><?= $oProduct->getIngredients(); ?></p>
	</section>
</div>

<?php endforeach; ?>