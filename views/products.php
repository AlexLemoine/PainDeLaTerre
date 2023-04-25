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
		
			<?php include '_products.php'; ?>

	</div>

</main>

