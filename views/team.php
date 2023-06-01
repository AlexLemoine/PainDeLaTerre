<main class="MainContent Products layout layout-front" id="team">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Découvrez notre équipe</h1>
	</div>
	
	<section class="History">
		<h2 class="History-title">Notre histoire</h2>
		<p class="History-resume"><?= $team->getDescResume(); ?></p>
	</section>

	<section class="Projet">
		<h2  class="Projet-title">La genèse du projet</h2>
		<p  class="Projet-resume"><?= $team->getDescOrigin(); ?></p>
	</section>

	<section class="Members">
		<h2 class="Members-title">Présentation de l'équipe</h2>
		<img src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_TEAM . DIRECTORY_SEPARATOR . $team->getPicture(); ?>">
		
		<div class="Members-container">
			<?php include '_members.php'; ?>
		</div>
	</section>
	
</main>
