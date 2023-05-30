<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm">
	
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications" data-action="save">


	<div class="Presentation-sliderCompany-list">
		<?php foreach ($oSliderCompany as $slide): ?>
		<!-- Image -->
			<div class="Presentation-sliderCompany-imgBox" data-id="<?= !empty($slide) ? $slide->getId() : ''; ?>">
				<label for="picture-<?= !empty($slide) ? $slide->getId() : ''; ?>"></label>
				<?php if(!empty($slide)): ?>
					<img class="Presentation-sliderCompany-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR . $slide->getUrl(); ?>"
					     alt="<?= $slide->getLegend(); ?>">
				<?php endif; ?>
				<input type="file" id="picture-<?= !empty($slide) ? $slide->getId() : ''; ?>" value="<?= !empty($slide) ? $slide->getUrl() : ''; ?>" name="picture" accept="image/*">
			</div>
		<?php endforeach; ?>
	</div>
	
	<!-- Légende -->
<!--	<div>-->
<!--		<h3>Légende</h3>-->
<!--		<label for="legend"></label>-->
<!--		<input type="text" id="legend" name="legend" value="--><?php //= !empty($slide) ? $slide->getLegend() : ''; ?><!--">-->
<!--	</div>-->

</form>