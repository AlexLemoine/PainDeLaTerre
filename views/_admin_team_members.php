<?php foreach ($members as $oMember): ?>
	<div class="Members-list" data-id="<?= $oMember->getId(); ?>">
		<?php include '_admin_team_member.php'; ?>
	</div>
<?php endforeach;?>