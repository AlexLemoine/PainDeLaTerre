<main class="MainContent Search layout layout-back" id="admin_company">
	<div class="MainContent-titleWrap">
		<h1 class="MainContent-title">Gestion entreprise</h1>
	</div>
	
	<h2>Gestion des partenaires</h2>

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
	
	<!--  Liste des partenaires -->
	<div id= "Cards" class="Cards" data-context="<?= PAGE_ADMIN_COMPANY ?>">
		<?php include '_admin_partenaires.php'; ?>
	</div>

</main>

<script type="module" src="assets/js/admin_modify_company.js"></script>