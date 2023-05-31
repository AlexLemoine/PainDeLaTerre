<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm">
	
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications" data-action="save">


	<div class="Presentation-sliderCompany-list">
		<?php foreach ($oSliderCompany as $slide): ?>
		<!-- Image -->
			<div class="Presentation-sliderCompany-imgBox" data-id="<?= !empty($slide) ? $slide->getId() : ''; ?>">
				<input type="hidden" name="id-<?= !empty($slide) ? $slide->getId() : ''; ?>" value="<?= !empty($slide) ? $slide->getId() : ''; ?>">
				<label for="url-<?= !empty($slide) ? $slide->getId() : ''; ?>"></label>
				<?php if(!empty($slide)): ?>
					<img class="Presentation-sliderCompany-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR . $slide->getUrl(); ?>"
					     alt="<?= $slide->getLegend(); ?>">
				<?php endif; ?>
				<img data-id="<?= !empty($slide) ? $slide->getId() : ''; ?>" src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
				<input type="file" data-id="<?= !empty($slide) ? $slide->getId() : ''; ?>" id="url-<?= !empty($slide) ? $slide->getId() : ''; ?>" value="<?= !empty($slide) ? $slide->getUrl() : ''; ?>" name="url-<?= !empty($slide) ? $slide->getId() : ''; ?>" accept="image/*">
			</div>
		<?php endforeach; ?>
	</div>

</form>