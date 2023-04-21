<?php use Pdlt\Repository\ProductRepository; ?>
<main class="MainContent Products layout layout-front" id="main">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Découvrez nos produits</h1>
	</div>

	<!--  Afficher les filtres catégories -->
	<nav class="Products-filter" id="category">
		
		<?php
		foreach ($categories as $oCategory) {
			$bSelected = ($_SESSION['criterias']['category'] ?? '') == $oCategory->getId();
			echo '<a class="Products-filter-link"  href="?page=' . PAGE_AJAX_PRODUCTS . '&category=' . $oCategory->getId() . '">' .
			    $oCategory->getName() .
			    '</a>';
		}
		?>
		<?= '<a class="Products-filter-link filtered" data-reset="all" href="?page=' . PAGE_AJAX_PRODUCTS . '">Voir tout</a>'; ?>

	</nav>

	<div class="Products-list" id="container-ajax" data-context="<?= PAGE_PRODUCTS ?>">
		
		<?php
		
		$products = ProductRepository::findAll();
		
		foreach ($products as $oProduct) : ?>

			<div class="Products-list-card Card">
				<figure class="Card-imgBox">
					<img class="Card-imgBox-img" src="assets/img/<?= $oProduct->getPicture(); ?>"
					     alt="<?= $oProduct->getName(); ?>">
				</figure>
				<h2 class="Card-title"><?= $oProduct->getName(); ?></h2>

				<section class="Card-desc">
					<p class="Card-desc-text"><?= $oProduct->getDescription(); ?></p>
					<p class="Card-desc-frequency"><?= 'Disponible ' . $oProduct->getFrequency()->getDesignation(); ?></p>
				</section>

				<section class="Card-recipe">
					<h3 class="Card-recipe-title">Ingrédients</h3>
					<p class="Card-recipe-text"><?= $oProduct->getIngredients(); ?></p>
				</section>
			</div>
		
		<?php endforeach; ?>

	</div>

</main>

