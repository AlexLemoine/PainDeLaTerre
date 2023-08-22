<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">

<!--<div class="Member" data-id="--><?php //= $oMember->getId(); ?><!--">-->
	<h3 class="Member-name"><?= $oMember->getName(); ?></h3>
	<p class="Member-position"><?= $oMember->getPosition(); ?></p>
	<p class="Member-entryDate"><?= 'A rejoint l\'équipe depuis le : '
		. $oMember->getEntryDate()->format('d/m/Y'); ?>
	</p>
	<p class="Member-desc"><?= $oMember->getDescription(); ?></p>
	<img
		  class="Member-imgList-img"
		  data-id="<?= $oMember->getId() ?>"
		  alt="Photo de <?= $oMember->getName() ?>"
		  src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $oMember->getPicture(); ?>">
<!--</div>-->