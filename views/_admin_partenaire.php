
<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">

<div class="Card-Header">
	<figure class="Card-imgBox">
		<img class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oPartenaire->getPicture(); ?>"
		     alt="<?= $oPartenaire->getName(); ?>">
	</figure>
	<h3 class="Card-title"><?= $oPartenaire->getName(); ?></h3>
</div>

<div class="Card-localisation">
	<h3 class="Card-localisation-title">Localisation</h3>
	<p class="Card-localisation-text"><?= $oPartenaire->getLocalisation(); ?></p>
</div>

<div class="Card-supply">
	<h3 class="Card-supply-title">Type de fourniture</h3>
	<p class="Card-supply-text"><?= $oPartenaire->getSupply(); ?></p>
</div>

<div class="Card-desc">
	<h3 class="Card-desc-title">Description</h3>
	<p class="Card-desc-text"><?= $oPartenaire->getDescription(); ?></p>
</div>

<div class="Card-site">
	<h3 class="Card-site-title">Site web</h3>
	<p class="Card-site-text"><?= $oPartenaire->getSite(); ?></p>
</div>



