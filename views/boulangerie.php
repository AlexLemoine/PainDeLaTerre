<main class="MainContent Boulangerie layout layout-front" id="boulangerie">
	
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Notre boulangerie</h1>
	</div>


	<!--	VIDEO ENTREPRISE A VENIR  -->
	<img class="Boulangerie-media" src="assets/img/painsHeader.jpg" alt="Image de pains en cuisson">
	
	<section id="gamme" class="Boulangerie-gamme">

		<p class="Boulangerie-gamme-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "gamme") {
					echo $item->getText();
				}
			}; ?>
		</p>
		
	</section>

	<div class="Boulangerie-encart">
		<p class="Boulangerie-encart-tag left-animation">Des produits sains</p>
		<p class="Boulangerie-encart-tag right-animation">100% Bio</p>
	</div>
	
	
	<section id="produits" class="Boulangerie-produits">
		
		<h2 class="Boulangerie-produits-title">Nos produits</h2>

		<p class="Boulangerie-produits-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "produits") {
					echo $item->getText();
				}
			}; ?>
		</p>

		<img class="Boulangerie-produits-img" src="assets/img/champs_de_blé.png" alt="champs de blé">
		
		<a class="CTA" href="?page=<?= PAGE_PRODUCTS ?>">Découvrir nos produits</a>
		
	</section>
	
	<div class="Boulangerie-encart">
		<p class="Boulangerie-encart-tag left-animation">Développement durable</p>
		<p class="Boulangerie-encart-tag right-animation">Producteurs locaux</p>
	</div>
	
	
	<section id="partenaires" class="Boulangerie-partenaires">

		<h2 class="Boulangerie-partenaires-title">Nos partenaires</h2>

		<p class="Boulangerie-partenaires-text"><?php foreach ($presentation as $item) {
				if ($item->getTheme() === "partenaires") {
					echo $item->getText();
				}
			}; ?>
		</p>

		<img class="Boulangerie-partenaires-img" src="assets/img/field.jpg" alt="champs de blé">
		
		<a class="CTA" href="#">Découvrir nos partenaires</a>
	</section>
	
</main>

<script src="assets/js/boulangerieAnimation.js"></script>