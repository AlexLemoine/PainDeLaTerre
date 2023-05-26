<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm" data-id="<?= !empty($presentation) ? $presentation->getId() : ''; ?>">
	
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications" data-action="save">
	
	<section class="Card-desc">
		<h3 class="Card-desc-title">Description</h3>
		<label for="text"></label>
		<textarea id="text" name="text" rows="6"><?= !empty($presentation) ? $presentation->getText() : ''; ?></textarea>
	</section>

</form>