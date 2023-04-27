

<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">

<div class="Card-Header">
	<h2 class="Card-title"><?= $oPartenaire->getName(); ?></h2>
	<figure class="Card-imgBox">
		<img class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oPartenaire->getPicture(); ?>"
		     alt="<?= $oPartenaire->getName(); ?>">
	</figure>
	<p><?= $oPartenaire->getLocalisation(); ?></p>
</div>

<section class="Card-desc">
	<h3 class="Card-desc-title">Description</h3>
	<p class="Card-desc-text">
		<?php
		$desc = $oPartenaire->getDescription();
		echo (mb_substr($desc,0,20) . '...');
		?>
	</p>
</section>

