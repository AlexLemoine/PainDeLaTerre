<?php use Pdlt\Model\Product; ?>

<!-- enctype permet l'upload de fichiers -->
<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm" data-id="<?= !empty($product) ? $product->getId() : ''; ?>">
		
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications" data-action="save">
	
	<div>
		<label for="picture"></label>
		<figure class="Card-imgBox">
			<?php if(!empty($product)): ?>
			<img class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $product->getPicture(); ?>"
			     alt="<?= $product->getName(); ?>">
			<?php endif; ?>
		</figure>
		<input type="file" id="picture" value="<?= !empty($product) ? $product->getPicture() : ''; ?>" name="picture" accept="image/*">
	</div>

	<div class="Card-Header">
		<h3 class="Card-Header-title">Nom</h3>
		<label for="name"></label>
		<input class="Card-title" type="text" id="name" name="name" value="<?= !empty($product) ? $product->getName() : ''; ?>">
	</div>

	<div class="group-list">

		<section class="Card-category">
			<h3 class="Card-category-title">Catégorie</h3>
			<select class="Filters-category" id="category" name="category">
				<?php
				foreach ($categories as $oCategory) {
					$bSelected='';
					(!empty($product)) ?? $bSelected = ($product->getCategory()->getId() === $oCategory->getId());
					
					echo '<option class="Filters-category-option"' . ($bSelected ? ' selected="selected" ' : '') . ' value="'.$oCategory->getId().'">'.
					    $oCategory->getName() .
					    '</option>';
				}
				?>
			</select>
		</section>
		
		<section class="Card-status">
			<h3 class="Card-status-title">Statut</h3>
			<select class="Filters-status" id="status" name="status">
				<?php
				foreach (Product::STATUS as $key=>$oStatus) {
					$bSelected = '';
					    !empty($product) ?? $bSelected = ($product->getStatus() === $key);
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
					$bSelected = '';
					    !empty($product) ?? $bSelected = ($product->getFrequency()->getDesignation() === $oFrequency->getDesignation());
					echo '<option class="Filters-frequency-option" '. ($bSelected ? ' selected="selected" ' : '') . ' value="'.$oFrequency->getId().'">'.
					    $oFrequency->getDesignation() .
					    '</option>';
				}
				?>
			</select>
		</section>

	</div>


	<div class="group-list">

		<section class="Card-recipe">
			<h3 class="Card-recipe-title">Ingrédients</h3>
			<label for="ingredients"></label>
			<textarea id="ingredients" name="ingredients"><?= !empty($product) ? $product->getIngredients() : ''; ?></textarea>
		</section>
	
		<section class="Card-desc">
			<h3 class="Card-desc-title">Description</h3>
			<label for="description"></label>
			<textarea id="description" name="description"><?= !empty($product) ? $product->getDescription() : ''; ?></textarea>
		</section>
		
	</div>
	
</form>