<?php use Pdlt\Model\Product; ?>

<form method="post" action="#" class="Card ModifyForm" data-id="<?= $product->getId(); ?>">
		
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" data-action="save">
	
	<div>
		<label for="picture"></label>
		<figure class="Card-imgBox">
			<img class="Card-imgBox-img" src="assets/img/<?= $product->getPicture(); ?>"
			     alt="<?= $product->getName(); ?>">
		</figure>
		<input type="hidden" name="picture" value="<?= $product->getPicture(); ?>">
		<input type="file" id="picture" name="picture" accept="image/*">
	</div>

	<div class="Card-Header">
		<label for="name"></label>
		<input class="Card-title" type="text" id="name" name="name" value="<?= $product->getName(); ?>">
	</div>
	
	<section class="Card-category">
		<h3 class="Card-category-title">Catégorie</h3>
		<select class="Filters-category" id="category" name="category">
			<?php
			foreach ($categories as $oCategory) {
				$bSelected = ($product->getCategory()->getId() === $oCategory->getId());
				
				echo '<option class="Filters-category-option"' . ($bSelected ? ' selected="selected" ' : '') . ' value="'.$oCategory->getId().'">'.
				    $oCategory->getName() .
				    '</option>';
			}
			?>
		</select>
	</section>

	<section class="Card-recipe">
		<h3 class="Card-recipe-title">Ingrédients</h3>
		<label for="ingredients"></label>
		<textarea id="ingredients" name="ingredients"><?= $product->getIngredients(); ?></textarea>
	</section>

	<section class="Card-desc">
		<h3 class="Card-desc-title">Description</h3>
		<label for="description"></label>
		<textarea id="description" name="description"><?= $product->getDescription(); ?></textarea>
	</section>
	
	<section class="Card-status">
		<h3 class="Card-status-title">Statut</h3>
		<select class="Filters-status" id="status" name="status">
			<?php
			foreach (Product::STATUS as $key=>$oStatus) {
				$bSelected = ($product->getStatus() === $key);
				echo '<option class="Filters-status-option" '. ($bSelected ? ' selected="selected" ' : '') . ' value="'. $key .'">
							'. $oStatus .'
						</option>';
			}
			?>
		</select>
	</section>
	
	<section class="Card-frequency">
		<h3 class="Card-frequency-title">Fréquence</h3>
		<select class="Filters-frequency" id="frequency" name="frequency">
			<?php
			foreach ($frequencies as $oFrequency) {
				$bSelected = ($product->getFrequency() === $oFrequency);
				echo '<option class="Filters-frequency-option" '. ($bSelected ? ' selected="selected" ' : '') . ' value="'.$oFrequency->getId().'">'.
				    $oFrequency->getDesignation() .
				    '</option>';
			}
			?>
		</select>
	</section>
	
</form>