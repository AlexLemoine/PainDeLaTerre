<?php use Pdlt\Model\Product; ?>

	<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
	<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
	
	<div class="Card-Header">
		<h2 class="Card-title"><?= $oProduct->getName(); ?></h2>
		<figure class="Card-imgBox">
			<img id="img1" class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oProduct->getPicture(); ?>"
			     alt="<?= $oProduct->getName(); ?>">
		</figure>
		<?php $picture_secondary = $oProduct->getPictureSecondary();
		if(isset($picture_secondary)): ?>
		<figure class="Card-imgBox">
			<img id="img2" class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oProduct->getPictureSecondary(); ?>"
			     alt="<?= $oProduct->getName(); ?>">
		</figure>
		<?php endif; ?>
	</div>
	
	<section class="Card-category">
		<h3 class="Card-category-title">Catégorie</h3>
		<p class="Card-category-text"><?= $oProduct->getCategory()->getName(); ?></p>
	</section>

	<section class="Card-status">
		<h3 class="Card-status-title">Statut</h3>
		<p class="Card-status-text"><?= Product::STATUS[$oProduct->getStatus()]; ?></p>
	</section>
	
	<section class="Card-frequency">
		<h3 class="Card-frequency-title">Fréquence</h3>
		<p class="Card-frequency-text"><?= $oProduct->getFrequency()->getDesignation(); ?></p>
	</section>
	
	<section class="Card-recipe">
		<h3 class="Card-recipe-title">Ingrédients</h3>
		<p class="Card-recipe-text">
			<?php
			$ingredients = $oProduct->getIngredients();
			echo (mb_substr($ingredients,0,20) . '...');
			?>
		</p>
	</section>
	
	<section class="Card-desc">
		<h3 class="Card-desc-title">Description</h3>
		<p class="Card-desc-text">
			<?php
			$desc = $oProduct->getDescription();
			echo (mb_substr($desc,0,20) . '...');
			?>
		</p>
	</section>

