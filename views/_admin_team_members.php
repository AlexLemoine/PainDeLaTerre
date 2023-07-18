<?php foreach ($members as $oMember): ?>
	<div class="Members-list" data-id="<?= $oMember->getId(); ?>">
		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
		<?php include '_admin_team_member.php'; ?>
	</div>
<?php endforeach;?>