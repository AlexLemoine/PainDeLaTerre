<main class="MainContent Search layout layout-back Presentation" id="admin_presentation">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Gestion de la présentation</h1>
	</div>
	
	<section id="gamme" class="Presentation-gamme">

		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
		
		<h2 class="Presentation-produits-title">Présentation de la gamme</h2>
		
		<p class="Presentation-gamme-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "gamme") {
					echo $item->getText();
				}
			}; ?>
		</p>
	
	</section>
	
	<section id="produits" class="Presentation-produits">
		
		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">

		<h2 class="Presentation-produits-title">Présentation des produits</h2>
		
		<p class="Presentation-produits-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "produits") {
					echo $item->getText();
				}
			}; ?>
		</p>
		
	</section>
	
	<section id="partenaires" class="Presentation-partenaires">

		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
		<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">

		<h2 class="Presentation-partenaires-title">Présentation des partenaires</h2>
		
		<p class="Presentation-partenaires-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "partenaires") {
					echo $item->getText();
				}
			}; ?>
		</p>

	</section>
	
</main>