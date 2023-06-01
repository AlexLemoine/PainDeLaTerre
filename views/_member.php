<div class="Member" data-id="<?= $oMember->getId(); ?>">
	<img alt="Photo de <?= $oMember->getName(); ?>"
	     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $oMember->getPicture(); ?>">
	<h3 class="Member-name"><?= $oMember->getName(); ?></h3>
	<p class="Member-position"><?= $oMember->getPosition(); ?></p>
	<p class="Member-entryDate"><?= $oMember->getEntryDate()->format('d-m-Y'); ?></p>
	<p class="Member-desc"><?= $oMember->getDescription(); ?></p>
</div>

