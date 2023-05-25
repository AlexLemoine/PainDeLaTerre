<?php

// Besoin de ces lignes comme dans index

// Chargement de l'autoload de Composer
// va charger la librairie composer:
require 'vendor/autoload.php';

//On indique à PHP que l'on veut utiliser le concept des sessions
session_start();

require_once 'lib/config.php';

// Appeler le controller
if(isset($_POST['context'])){
	switch ($_POST['context'])
	{
		// Retourne la vue lors de la sélection de filtres
		// Vue: _admin_products
		case PAGE_ADMIN_PRODUCTS:
			echo (new Pdlt\Controller\AdminProductsController)->refreshProducts();
			break;
			
		// Retourne la vue d'un produit en mode formulaire pour la modification
		// Vue: _admin_modify_product
		case PAGE_ADMIN_MODIFY_PRODUCTS:
			echo (new Pdlt\Controller\AdminProductsController)->modifyProduct();
			break;
		
		// Met à jour le produit et affiche la vue du produit modifié
		// Vue: _admin_product
		case PAGE_ADMIN_UPDATE_PRODUCT:
			echo (new Pdlt\Controller\AdminProductsController)->updateProduct();
			break;
			
		// Retourne la vue d'un produit
		// Vue: _admin_product
		case PAGE_ADMIN_CANCEL_PRODUCT:
			echo (new Pdlt\Controller\AdminProductsController)->showProduct();
			break;
		
		// Retourne la vue d'un produit
		// Vue: _admin_product
		case PAGE_ADMIN_DELETE_PRODUCT:
			echo (new Pdlt\Controller\AdminProductsController)->deleteProduct();
			break;
			
		case PAGE_AJAX_SLIDER_PRODUCTS:
			echo (new Pdlt\Controller\ProductController)->sliderProduct();
			break;
		
		case PAGE_ADMIN_UPDATE_PARTENAIRES:
			echo(new Pdlt\Controller\AdminPartenairesController)->updatePartenaire();
			break;
			
		case PAGE_ADMIN_MODIFY_PARTENAIRES:
			echo(new Pdlt\Controller\AdminPartenairesController)->modifyPartenaire();
			break;
			
		case PAGE_ADMIN_CANCEL_PARTENAIRE:
			echo(new Pdlt\Controller\AdminPartenairesController)->showPartenaire();
			break;
			
		case ADMIN_DELETE_PARTENAIRE:
			echo(new Pdlt\Controller\AdminPartenairesController)->deletePartenaire();
			break;
		
		case PAGE_ADMIN_PARTENAIRES:
			echo(new Pdlt\Controller\AdminPartenairesController)->refreshPartenaires();
			break;
			
		case PAGE_ADMIN_MODIFY_PRESENTATION:
			echo(new Pdlt\Controller\AdminPresentationController)->modifyPresentation();
			break;
	
	}
}

