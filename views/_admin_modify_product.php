<?php use Pdlt\Model\Product; ?>

<!-- enctype permet l'upload de fichiers -->
<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm"
	data-id="<?= !empty($product) ? $product->getId() : ''; ?>">

	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler"
	     data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications"
	     data-action="save">

	<!-- Image principale -->
	<div>
		<label for="picture"></label>
		<figure class="Card-imgBox">
			<?php if (!empty($product)): ?>
				<img id="img1" class="Card-imgBox-img"
				     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $product->getPicture(); ?>"
				     alt="<?= $product->getName(); ?>">
			<?php endif; ?>
		</figure>
		<input type="file" id="picture" value="<?= !empty($product) ? $product->getPicture() : ''; ?>"
			 name="picture" accept="image/*">
	</div>

	<!-- Image secondaire -->
	<div>
		<label for="picture_secondary"></label>
		<figure class="Card-imgBox">
			<?php if (!empty($product)): ?>
				<img id="img2" class="Card-imgBox-img"
				     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $product->getPictureSecondary(); ?>"
				     alt="<?= $product->getName(); ?>">
			<?php endif; ?>
		</figure>
		<input type="file" id="picture_secondary"
			 value="<?= !empty($product) ? $product->getPictureSecondary() : ''; ?>" name="picture_secondary"
			 accept="image/*">
	</div>

	<div class="Card-Header">
		<h3 class="Card-Header-title">Nom</h3>
		<label for="name"></label>
		<input class="Card-title" type="text" id="name" name="name"
			 value="<?= !empty($product) ? $product->getName() : ''; ?>">
	</div>

	<div class="group-list">

		<section class="Card-category">
			<h3 class="Card-category-title">Catégorie</h3>
			<select class="Filters-category" id="category" name="category">
				
				<?php foreach ($categories as $oCategory): ?>

					<option class="Filters-category-option"
					    <?php if (!empty($product)) : ?>
					    <?= ( $oCategory->getId() == $product->getCategory()->getId()) ? 'selected="selected" ' : ''; ?>

						  value="<?= $oCategory->getId(); ?>">
						
						<?= $oCategory->getName(); ?>
						
						<?php else: echo  'value="' . $oCategory->getId() . '">';
							
							echo $oCategory->getName();
							
							?>
						
						<?php endif; ?>


					</option>
				
				<?php endforeach; ?>
				
			</select>
		</section>

		<section class="Card-status">
			<h3 class="Card-status-title">Statut</h3>
			<select class="Filters-status" id="status" name="status">
				<?php foreach (Product::STATUS as $key => $oStatus) :?>

					<option class="Filters-status-option"
					    <?php if (!empty($product)) : ?>
					    <?= $product->getStatus() === $key ? 'selected="selected" ' : ''; ?>

						  value="<?= $key; ?>">
						
						<?= $oStatus; ?>
						
						<?php else: echo  'value="' . $key . '">';

							echo $oStatus;

						?>
						
						<?php endif; ?>
					</option>
				
				<?php endforeach; ?>
			</select>
		</section>

		<section class="Card-frequency">
			<h3 class="Card-frequency-title">Fréquence</h3>
			<select class="Filters-frequency" id="frequency" name="frequency">
				
				<?php foreach ($frequencies as $oFrequency): ?>

					<option class="Filters-frequency-option"
					    <?php if (!empty($product)) : ?>
					    <?= ($product->getFrequency()->getDesignation() == $oFrequency->getDesignation()) ? 'selected="selected" ' : ''; ?>

						  value="<?= $oFrequency->getId(); ?>">
						
						<?= $oFrequency->getDesignation(); ?>
						
						<?php else: echo  'value="' . $oFrequency->getId() . '">';
							
							echo $oFrequency->getDesignation();
						
						?>
						
						<?php endif; ?>
						
						
					</option>
				
				<?php endforeach; ?>

			</select>
		</section>

	</div>


	<div class="group-list">

		<section class="Card-recipe">
			<h3 class="Card-recipe-title">Ingrédients</h3>
			<label for="ingredients"></label>
			<textarea id="ingredients"
				    name="ingredients"><?= !empty($product) ? $product->getIngredients() : ''; ?></textarea>
		</section>

		<section class="Card-desc">
			<h3 class="Card-desc-title">Description</h3>
			<label for="description"></label>
			<textarea id="description"
				    name="description"><?= !empty($product) ? $product->getDescription() : ''; ?></textarea>
		</section>

	</div>

</form>
