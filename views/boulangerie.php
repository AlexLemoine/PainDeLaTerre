<main class="MainContent Boulangerie layout layout-front" id="boulangerie">
	
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Notre boulangerie</h1>
	</div>
	
	<section id="gamme">

		<p><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "gamme") {
					echo $item->getText();
				}
			}; ?>
		</p>
		
		<!--	VIDEO ENTREPRISE A VENIR  -->
		<img src="assets/img/painsHeader.jpg" alt="Image de pains en cuisson">
		
	</section>
	
	
	<section id="produits">

		<p><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "produits") {
					echo $item->getText();
				}
			}; ?>
		</p>

		
		<a class="CTA" href="?page=<?= PAGE_PRODUCTS ?>">Découvrir nos produits</a>
	</section>
	
	
	<section id="partenaires">

		<p><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "partenaires") {
					echo $item->getText();
				}
			}; ?>
		</p>
		
		<a class="CTA" href="#">Découvrir nos partenaires</a>
	</section>
	
	

	
</main>