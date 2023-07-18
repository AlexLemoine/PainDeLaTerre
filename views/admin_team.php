<main class="MainContent Search layout layout-back" id="<?= PAGE_ADMIN_TEAM ?>">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title"><?= $seo_title; ?></h1>
	</div>
	
	
	<!-- Affichage de la photo d'équipe -->
	<section id="team" class="Team">
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
			<div class="Members-creation-form hidden">
				<?php include '_admin_modify_members.php'; ?>
			</div>
		</div>

		
		<h2 class="Members-title">GERER LES MEMBRES DE L'EQUIPE</h2>
		<!-- Liste des membres -->
		<div class="container-ajax-member" data-context="<?= PAGE_ADMIN_MEMBERS; ?>">
			<?php include '_admin_team_members.php'; ?>
		</div>
		
	</section>
	
</main>

<script type="module" src="assets/js/admin_modify_team.js"></script>