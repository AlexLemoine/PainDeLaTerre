<!-- enctype permet l'upload de fichiers -->
<form method="post" action="#" enctype="multipart/form-data" class="Card ModifyForm" data-id="<?= !empty($oMember) ? $oMember->getId() : ''; ?>">
	
	<img src="assets/img/cancelButton.svg" class="Card-cancel" alt="cancel button" title="Annuler" data-action="cancel">
	<img src="assets/img/saveButton.svg" class="Card-save" alt="save button" title="Enregistrer les modifications" data-action="save">
	
	<!-- Image du membre -->
	<div>
		<label for="picture"></label>
		<figure class="Card-imgBox">
			<?php if(!empty($oMember)): ?>
				<img id="picture-creation" class="Card-imgBox-img"
				     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $oMember->getPicture(); ?>"
				     alt="<?= 'Image de ' . $oMember->getName(); ?>">
			<?php endif; ?>
		</figure>
		<input type="file" id="picture" value="<?= !empty($oMember) ? $oMember->getPicture() : ''; ?>" name="picture" accept="image/*">
	</div>
	
	<!-- Nom du membre -->
	<div class="Card-Header">
		<h3 class="Card-Header-title">Nom</h3>
		<label for="name"></label>
		<input class="Card-title" type="text" id="name" name="name" value="<?= !empty($oMember) ? $oMember->getName() : ''; ?>">
	</div>
	
	<!-- Poste du membre -->
	<div class="Card-position">
		<h3 class="Card-position-title">Poste</h3>
		<label for="position"></label>
		<textarea id="position" name="position"><?= !empty($oMember) ? $oMember->getPosition() : ''; ?></textarea>
	</div>
	
	<!-- Description du membre -->
	<div class="Card-description">
		<h3 class="Card-description-title">Description</h3>
		<label for="description"></label>
		<textarea id="description" name="description"><?= !empty($oMember) ? $oMember->getDescription() : ''; ?></textarea>
	</div>
	
	<!-- Date d'entrée du membre -->
	<div class="Card-entry_date">
		<h3 class="Card-entry_date-title">Date d'entrée</h3>
		<label for="entry_date"></label>
		<input id="entry_date" type="date" name="entry_date"><?= !empty($oMember) ? $oMember->getEntryDate()->format('d/m/Y') : ''; ?></input>
	</div>
	
</form>