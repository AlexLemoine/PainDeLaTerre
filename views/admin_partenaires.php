<?php use Pdlt\Model\Partenaires; ?>

<main class="MainContent Search layout layout-back" id="admin_partenaires">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title"><?= $seo_title; ?></h1>
	</div>

	<!-- Bouton de création de partenaire -->
	<div class="Card-create">
		<img src="assets/img/addButton.svg" class="Card-create-button" alt="addButton" title="Créer un partenaire">
		<p class="Card-create-title">Créer un partenaire</p>
	</div>
	
	<!-- Formulaire de création de partenaire -->
	<div class="Card-create-form creating hidden">
		<p class="Card-create-title">Création d'un partenaire</p>
		<?php include '_admin_modify_partenaires.php'; ?>
	</div>


	<div class="Search-title">Filtrage des résultats</div>

	<form id="form" class="Search-form" action="?page=<?php echo $_GET['page']; ?>" method="POST">
		<div class="Search-form-filters Filters">
			<!-- Recherche multi-critères -->
			<input class="Filters-magic" type="text" id="magic-search" name="magic-search" value=""
				 placeholder="Recherche mots-clés">

			<!--	Statut -->
			<select class="Filters-status" id="status" name="status">
				<option class="Filters-status-option" value="">Filtrer par statut</option>
				<?php
				
				foreach (Partenaires::STATUS as $key=>$oStatus) {
					echo '<option class="Filters-status-option" value="'. $key .'">
							'. $oStatus .'
						</option>';
				}
				?>
			</select>

			<button title="Reset" value="reset">Supprimer les filtres</button>

		</div>
	</form>
	
	<!--  Liste des partenaires -->
	<div id= "Cards" class="Cards" data-context="<?= PAGE_ADMIN_PARTENAIRES ?>">
		<?php include '_admin_partenaires.php'; ?>
	</div>

</main>

<script type="module" src="assets/js/admin_modify_partenaires.js"></script>