<?php use Pdlt\Model\Product; ?>
<main class="MainContent Search layout layout-back" id="main">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Gestion des produits</h1>
	</div>

	<!--  Filtre produits -->
	<div class="Search layout">

		<div class="Card-create">
			<img src="assets/img/addButton.svg" class="Card-create-button" alt="addButton" title="Créer un produit">
			<p class="Card-create-title">Créer un produit</p>
		</div>
		<div class="Card-create-form creating hidden">
			<p class="Card-create-title">Création du produit</p>
			<?php include '_admin_modify_product.php'; ?>
		</div>
		
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

				<button title="Reset" value="reset">Supprimer les filtres</button>

			</div>

		</form>
	</div>

	<!--  Liste produits -->

	<div id= "Cards" class="Cards" data-context="<?= PAGE_ADMIN_PRODUCTS ?>">
		<?php include '_admin_products.php'; ?>
	</div>

</main>