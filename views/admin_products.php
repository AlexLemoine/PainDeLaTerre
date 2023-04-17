<?php use Pdlt\Model\Product; ?>
<main class="MainContent Search layout layout-back">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Gestion des produits</h1>
	</div>

	<!--  Filtre produits -->
	<div class="Search layout">
		<div class="Search-title">Filtrage des résultats</div>

		<form id="form" class="Search-form" action="?page=<?php echo $_GET['page']; ?>" method="POST">
			<div class="Search-form-filters Filters">
				<!-- Recherche multi-critères -->
				<input class="Filters-magic" type="text" id="magic-search" name="magic-search" value=""
					 placeholder="Recherche mots-clés">

				<!-- Catégories -->
				<select class="Filters-category" id="category" name="category">
					<option class="Filters-category-option" value="">Filtrer par catégorie</option>
					<?php
					
					foreach ($categories as $oCategory) {
						$bSelected = ($_SESSION['criterias']['category'] ?? '') == $oCategory->getId();
						echo '<option class="Filters-category-option"  value="'.$oCategory->getId().'">'.
						    $oCategory->getName() .
						    '</option>';
					}
					?>
				</select>

				<!--	Statut -->
				<select class="Filters-status" id="status" name="status">
					<option class="Filters-status-option" value="">Filtrer par statut</option>
					<?php
					
					foreach (Product::STATUS as $key=>$oStatus) {
						echo '<option class="Filters-status-option" value="'. $key .'">
							'. $oStatus .'
						</option>';
					}
					?>
				</select>


				<button value="reset">Reset</button>

			</div>

		</form>
	</div>

	<!--  Liste produits -->
	<p class="Search-title">Produit(s) sélectionné(s)</p>

	<div id= "Cards" class="Cards" data-context="<?= PAGE_ADMIN_PRODUCTS ?>">
		<?php include '_admin_products.php'; ?>
	</div>

</main>