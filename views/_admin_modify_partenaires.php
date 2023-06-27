<?php use Pdlt\Model\Partenaires; ?>

<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm"
	data-id="<?= !empty($partenaire) ? $partenaire->getId() : ''; ?>">

	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler"
	     data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications"
	     data-action="save">

	<div>
		<label for="picture"></label>
		<figure class="Card-imgBox">
			<?php if (!empty($partenaire)): ?>
				<img class="Card-imgBox-img"
				     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $partenaire->getPicture(); ?>"
				     alt="<?= $partenaire->getName(); ?>">
			<?php endif; ?>
		</figure>
		<input type="file" id="picture" value="<?= !empty($partenaire) ? $partenaire->getPicture() : ''; ?>"
			 name="picture" accept="image/*">
	</div>

	<div class="Card-Header">
		<h3 class="Card-Header-title">Nom</h3>
		<label for="name"></label>
		<input class="Card-title" type="text" id="name" name="name"
			 value="<?= !empty($partenaire) ? $partenaire->getName() : ''; ?>">
	</div>

	<section class="Card-status">
		<h3 class="Card-status-title">Statut</h3>
		<select class="Filters-status" id="status" name="status">
			<?php
			foreach (Partenaires::STATUS as $key => $oStatus) {
				$bSelected = '';
				    !empty($partenaire) ?? $bSelected = ($partenaire->getStatus() === $key);
				echo '<option class="Filters-status-option" ' . ($bSelected ? ' selected="selected" ' : '') . ' value="' . $key . '">
								' . $oStatus . '
							</option>';
			}
			?>
		</select>
	</section>

	<section class="Card-localisation">
		<h3 class="Card-localisation-title">Localisation</h3>
		<label for="localisation"></label>
		<input class="Card-title" type="text" id="localisation" name="localisation"
			 value="<?= !empty($partenaire) ? $partenaire->getLocalisation() : ''; ?>">
	</section>

	<section class="Card-supply">
		<h3 class="Card-supply-title">Type de fourniture</h3>
		<label for="supply"></label>
		<textarea id="supply" name="supply"><?= !empty($partenaire) ? $partenaire->getSupply() : ''; ?></textarea>
	</section>

	<section class="Card-desc">
		<h3 class="Card-desc-title">Description</h3>
		<label for="description"></label>
		<textarea id="description"
			    name="description"><?= !empty($partenaire) ? $partenaire->getDescription() : ''; ?></textarea>
	</section>

	<section class="Card-site">
		<h3 class="Card-site-title">Site internet</h3>
		<label for="site"></label>
		<textarea id="site" name="site"><?= !empty($partenaire) ? $partenaire->getSite() : ''; ?></textarea>
	</section>

</form>