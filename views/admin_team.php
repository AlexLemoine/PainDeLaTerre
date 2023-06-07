<main class="MainContent Search layout layout-back" id="<?= PAGE_ADMIN_TEAM ?>">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title"><?= $seo_title; ?></h1>
	</div>

	<!--  Liste des membres -->
	<div id="Members" class="Members" data-context="<?= PAGE_ADMIN_TEAM ?>">
		
		<?php foreach ($members as $oMember): ?>
			<div class="Members-list" data-id="<?= $oMember->getId(); ?>">
				<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
				<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
				<?php include '_member.php'; ?>
			</div>
		<?php endforeach;
		// TODO en JS, enlever la classe hidden de toutes les div.Member de la vue _member.php
		?>
		
	</div>
	
</main>