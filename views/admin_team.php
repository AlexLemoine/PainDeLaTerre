<main class="MainContent Search layout layout-back" id="<?= PAGE_ADMIN_TEAM ?>">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title"><?= $seo_title; ?></h1>
	</div>
	
	
	<!-- Affichage de la photo d'équipe -->
	<section class="Team">
		<h2 class="Team-title">GERER LA PHOTO DE L'EQUIPE</h2>
		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		<img class="Team-img"
		     alt="Photo de l'équipe au complet"
		     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_TEAM . DIRECTORY_SEPARATOR . $team->getPicture(); ?>">
	</section>
	

	<!--  Liste des membres -->
	<section id="Members" class="Members" data-context="<?= PAGE_ADMIN_TEAM ?>">
		
		<!-- Création d'un nouveau membre -->
		<div class="Members-creation">
			<h2 class="Members-creation-title">CREER UN NOUVEAU MEMBRE</h2>
			<img src="assets/img/addButton.svg" class="Card-create-button" alt="addButton" title="Créer un produit">
			<div class="Members-creation-form">
				<?php include '_admin_modify_members.php'; ?>
			</div>
		</div>

		<h2 class="Members-title">GERER LES MEMBRES DE L'EQUIPE</h2>
		<?php foreach ($members as $oMember): ?>
			<div class="Members-list" data-id="<?= $oMember->getId(); ?>">
				<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
				<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
				<?php include '_member.php'; ?>
			</div>
		<?php endforeach;?>
		
	</section>
	
</main>