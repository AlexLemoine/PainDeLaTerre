<main class="MainContent Search layout layout-back Presentation" id="admin_presentation">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Gestion de la présentation</h1>
	</div>
	
	<section id="gamme"
		   class="Presentation-gamme"
		   data-id="<?php foreach ($presentation as $item) {
			   if ($item->getTheme() === "gamme") {
				   echo $item->getId();
			   }
		   }; ?>">

		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		
		<h2 class="Presentation-produits-title">Présentation de la gamme</h2>
		
		<div class="container-text">
			<p class="Presentation-gamme-text"><?php foreach ($presentation as $item) {
					if ($item->getTheme() === "gamme") {
						echo $item->getText();
					}
				}; ?>
			</p>
		</div>
	
	</section>
	
	<section id="produits"
		   class="Presentation-produits"
		   data-id="<?php foreach ($presentation as $item) {
		if ($item->getTheme() === "produits") {
			echo $item->getId();
		}
	}; ?>">
		
		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">

		<h2 class="Presentation-produits-title">Présentation des produits</h2>

		<div class="container-text">
			<p class="Presentation-produits-text"><?php foreach ($presentation as $item) {
					if ($item->getTheme() === "produits") {
						echo $item->getText();
					}
				}; ?>
			</p>
		</div>
		
	</section>
	
	<section id="partenaires"
		   class="Presentation-partenaires"
		   data-id="<?php foreach ($presentation as $item) {
			if ($item->getTheme() === 'partenaires') {
				echo $item->getId();
			}
		   }; ?>">

		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">

		<h2 class="Presentation-partenaires-title">Présentation des partenaires</h2>

		<div class="container-text">
			<p class="Presentation-partenaires-text"><?php foreach ($presentation as $item) {
					if ($item->getTheme() === 'partenaires') {
						echo $item->getText();
					}
				}; ?>
			</p>
		</div>

	</section>
	
</main>

<script type="module" src="assets/js/admin_modify_presentation.js"></script>
