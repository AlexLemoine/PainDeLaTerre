<main class="MainContent Products layout layout-front" id="<?= PAGE_TEAM; ?>">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Découvrez notre équipe</h1>
	</div>

	<section class="Projet">
		<h2 class="Projet-title">La genèse du projet - notre histoire</h2>
		<p class="Projet-resume"><?= $team->getDescOrigin(); ?></p>
	</section>

	<section class="Members">
		<h2 class="Members-title">La fine équipe</h2>
		<img class="Members-img"
		     alt="Photo de l'équipe au complet"
		     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_TEAM . DIRECTORY_SEPARATOR . $team->getPicture(); ?>">
		<p class="Members-resume"><?= $team->getDescResume(); ?></p>

		<h2 class="Members-title">Découvrez les membres de l'équipe</h2>
		<div class="Members-container">
			<?php include '_members.php'; ?>
		</div>
	</section>
	
	<section class="Career">
		<h2 class="Career-title">Envie de nous rejoindre ?</h2>
		<p class="Career-msg">Que vous soyez à la recherche d'un stage ou que vous ayez une envie de
		nous rejoindre, nous vous invitons à nous contacter. Nous vous rappellerons avec plaisir !</p>
		<a class="CTA" href="#">Nous contacter</a>
	</section>

</main>

<script type="module" src="assets/js/team.js"></script>

