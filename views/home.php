<main class="MainContent Products layout Home" id="main">

	<div class="Home-header">
		<p class="Home-header-slogan">Des pains qui ont de la gueule et du goût</p>
	</div>

	<h1 class="MainContent-title">Qui sommes-nous ?</h1>

	<nav class="Home-sections" id="equipe">
		<a class="Home-sections-title-selected" href="#equipe">Une équipe passionnée</a>
		<a class="Home-sections-title" href="#savoir_faire">Un savoir-faire</a>
		<a class="Home-sections-title" href="#gamme">Une gamme diversifiée</a>
		<a class="Home-sections-title" href="#valeurs">Nos valeurs</a>
		<a class="Home-sections-title" href="#partenaires">Nos partenaires</a>
	</nav>

	<div class="Home-sections-section Section">
		<section class="Section-equipe">
			<h2 class="Section-equipe-title">Notre équipe</h2>
			<figure class="Section-equipe-imgBox">
				<img class="Section-equipe-imgBox-img" src="assets/img/equipe2023.jpg" alt="image de l'équipe">
				<figcaption class="Section-equipe-imgBox-legend">L'équipe réunie</figcaption>
			</figure>
			<p class="Section-equipe-desc">
				Formés auprès de l’Ecole Internationale de Boulangerie, nous sommes spécialisés dans les
				<strong>fermentations au levain naturel</strong>. Nous mettons notre passion et notre
				savoir-faire au service de <strong>pains goûteux et nutritifs</strong>, à la <strong>conservation
					hors du commun</strong>.
			</p>
			<a class="CTA" href="#">Découvrir l'équipe</a>
			
		</section>
	</div>

	<div class="MainContent-titleWrap">
		<p class="MainContent-slogan">
			DE JOYEUX LURONS, PASSIONNES DE FERMENTATIONS NATURELLES, AU SERVICE DE PAINS GOÛTEUX, NUTRITIFS ET DE
			CONSERVATION EXCEPTIONNELLE
		</p>
	</div>


	<nav class="Home-sections" id="savoir_faire">
		<a class="Home-sections-title" href="#equipe">Une équipe passionnée</a>
		<a class="Home-sections-title-selected" href="#savoir_faire">Un savoir-faire</a>
		<a class="Home-sections-title" href="#gamme">Une gamme diversifiée</a>
		<a class="Home-sections-title" href="#valeurs">Nos valeurs</a>
		<a class="Home-sections-title" href="#partenaires">Nos partenaires</a>
	</nav>

	<div class="Home-sections-section Section">
		<section class="Section-savoir_faire">
			<h2 class="Section-savoir_faire-title">Notre savoir-faire</h2>
			<p class="Section-savoir_faire-desc">
				Formés auprès de l’Ecole Internationale de Boulangerie, nous sommes spécialisés dans les
				<strong>fermentations au levain naturel</strong>. Nous mettons notre passion et notre
				savoir-faire au service de <strong>pains goûteux et nutritifs</strong>, à la <strong>conservation
					hors du commun</strong>.
			</p>

			<div class="Section-savoir_faire-slider CompanySlider">
				<div class="slide-container">
					<?php use Pdlt\Model\Partenaires;
					
					foreach ($sliders as $index => $companySlider): ?>
						<?php include '_slider_company.php'; ?>
					<?php endforeach; ?>
					
				</div>
			</div>
			
			<a class="CTA" href="#">En savoir plus</a>

		</section>
	</div>

	<div class="MainContent-titleWrap">
		<p class="MainContent-slogan Citation">
			Le pain gonfle en prenant la forme de la paume du boulanger.
			<br>
			Le porter à sa bouche, c'est comme serrer la main de qui l'a pétri.
			<br>
			<br>
			<i>Trois Chevaux (1999), par Erri De Luca</i>
		</p>
	</div>


	<nav class="Home-sections" id="gamme">
		<a class="Home-sections-title" href="#equipe">Une équipe passionnée</a>
		<a class="Home-sections-title" href="#savoir_faire">Un savoir-faire</a>
		<a class="Home-sections-title-selected" href="#gamme">Une gamme diversifiée</a>
		<a class="Home-sections-title" href="#valeurs">Nos valeurs</a>
		<a class="Home-sections-title" href="#partenaires">Nos partenaires</a>
	</nav>

	<div class="Home-sections-section Section">
		<section class="Section-gamme">
			<h2 class="Section-gamme-title">Des produits hors du commun</h2>

			<!-- Slider cards -->
			<div id="sliderProduct" data-limit="<?= count($filteredProducts); ?>">
			</div>
			<div class="Section-gamme-aside">
				<p class="Section-gamme-desc">
					Nos pains sont exclusivement fermentés au <b>levain naturel, de notre fabrication</b>.
					<br>
					Blé, seigle, petit épeautre et farines <b>pauvres en gluten</b>.
					<br>
					Découvrez aussi nos brioches régionales et autres petites <b>gourmandises</b>.
				</p>
				<a class="CTA" href="?page=<?= PAGE_PRODUCTS ?>">Découvrir nos produits</a>
			</div>
		</section>
	</div>


	<div class="MainContent-slogan">
		<p class="MainContent-slogan-title">FARINES PAUVRES EN GLUTEN</p>
		<p class="MainContent-slogan-title">LEVAIN NATUREL</p>
		<p class="MainContent-slogan-title">PETITES GOURMANDISES</p>
	</div>


	<nav class="Home-sections" id="valeurs">
		<a class="Home-sections-title" href="#equipe">Une équipe passionnée</a>
		<a class="Home-sections-title" href="#savoir_faire">Un savoir-faire</a>
		<a class="Home-sections-title" href="#gamme">Une gamme diversifiée</a>
		<a class="Home-sections-title-selected" href="#valeurs">Nos valeurs</a>
		<a class="Home-sections-title" href="#partenaires">Nos partenaires</a>
	</nav>

	<div class="Home-sections-section Section">
		<section class="Section-valeurs">
			<div class="circle">
				<h2 class="Section-valeurs-title">Nos valeurs, nos engagements</h2>

				<p class="Section-valeurs-desc">
					Tous nos produits sont certifiés en <strong>agriculture biologique</strong>. Nos farines
					sont issues de <strong>céréales locales</strong>, transformées par le Moulin Pichard
					(Malijai, 04) et la Ferme Pastière (Meyrargues, 13).
					Nos compositions sont <strong>claires et transparentes, sans améliorant</strong>,
					uniquement à base de matières premières brutes de <strong>première qualité</strong>.
				</p>
			</div>
			<div class="Section-valeurs-certifications">
				<img class="Section-valeurs-certifications-img" title="certification agriculture biologique"
				     alt="certification agriculture biologique" src="assets/img/logoAgricultureBio.svg">
				<img class="Section-valeurs-certifications-img" title="certification EU Organic"
				     alt="certification EU Organic" src="assets/img/logoEUOrganic.svg">
				<img class="Section-valeurs-certifications-img" title="certification Initiative remarquable"
				     alt="certification Initiative remarquable" src="assets/img/logoInitiativeRemarquable.svg">
			</div>

			<a class="CTA" href="#">En savoir plus</a>
		</section>
	</div>

	<nav class="Home-sections" id="partenaires">
		<a class="Home-sections-title" href="#equipe">Une équipe passionnée</a>
		<a class="Home-sections-title" href="#savoir_faire">Un savoir-faire</a>
		<a class="Home-sections-title" href="#gamme">Une gamme diversifiée</a>
		<a class="Home-sections-title" href="#valeurs">Nos valeurs</a>
		<a class="Home-sections-title-selected" href="#partenaires">Nos partenaires</a>
	</nav>

	<div class="Home-sections-section Section">
		<section class="Section-partenaires">

			<h2 class="Section-partenaires-title">Nos partenaires</h2>
			<div class="Section-partenaires-list">
				<?php
				$names = [];
				foreach ($partenaires as $oPartenaire) {
					if ($oPartenaire->getStatus() == Partenaires::STATUS_PUBLISHED) {
						$names[] = '<a target="blank" href="' . (!empty($oPartenaire->getSite()) ? $oPartenaire->getSite() : '#') . '" class="Section-partenaires-list-supplier">' . $oPartenaire->getName() . '</a>';
					}
				}
				$names = array_filter($names);
				echo implode(PHP_EOL . '| ', $names);
				?>
			</div>
			<a class="CTA" href="#">Découvrir nos producteurs</a>
		</section>
	</div>

</main>

<script type="module" src="assets/js/sliderCompany.js"></script>
<script type="module" src="assets/js/sliderProducts.js"></script>