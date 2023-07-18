<?php

// Besoin de ces lignes comme dans index

// Chargement de l'autoload de Composer
// va charger la librairie composer:
require 'vendor/autoload.php';

//On indique à PHP que l'on veut utiliser le concept des sessions
session_start();

require_once 'lib/config.php';

// Appeler la fonction du Controller selon le contexte AJAX
if(isset($_POST['context'])){
	
	$result = match ($_POST['context']) {
		PAGE_ADMIN_PRODUCTS => (new Pdlt\Controller\AdminProductsController)->refreshProducts(),
		PAGE_ADMIN_MODIFY_PRODUCTS => (new Pdlt\Controller\AdminProductsController)->modifyProduct(),
		PAGE_ADMIN_UPDATE_PRODUCT => (new Pdlt\Controller\AdminProductsController)->updateProduct(),
		PAGE_ADMIN_CANCEL_PRODUCT => (new Pdlt\Controller\AdminProductsController)->showProduct(),
		PAGE_ADMIN_DELETE_PRODUCT => (new Pdlt\Controller\AdminProductsController)->deleteProduct(),
		PAGE_AJAX_SLIDER_PRODUCTS => (new Pdlt\Controller\ProductController)->sliderProduct(),
		PAGE_ADMIN_UPDATE_PARTENAIRES => (new Pdlt\Controller\AdminPartenairesController)->updatePartenaire(),
		PAGE_ADMIN_MODIFY_PARTENAIRES => (new Pdlt\Controller\AdminPartenairesController)->modifyPartenaire(),
		PAGE_ADMIN_CANCEL_PARTENAIRE => (new Pdlt\Controller\AdminPartenairesController)->showPartenaire(),
		ADMIN_DELETE_PARTENAIRE => (new Pdlt\Controller\AdminPartenairesController)->deletePartenaire(),
		PAGE_ADMIN_PARTENAIRES => (new Pdlt\Controller\AdminPartenairesController)->refreshPartenaires(),
		PAGE_ADMIN_MODIFY_PRESENTATION => (new Pdlt\Controller\AdminPresentationController)->modifyPresentation(),
		PAGE_ADMIN_CANCEL_PRESENTATION => (new Pdlt\Controller\AdminPresentationController)->showPresentation(),
		PAGE_ADMIN_UPDATE_PRESENTATION => (new Pdlt\Controller\AdminPresentationController)->updatePresentation(),
		PAGE_ADMIN_MODIFY_SLIDER_COMPANY => (new Pdlt\Controller\AdminPresentationController)->modifySliderCompany(),
		PAGE_ADMIN_CANCEL_SLIDER_COMPANY => (new Pdlt\Controller\AdminPresentationController)->refreshSliderCompany(),
		PAGE_ADMIN_UPDATE_SLIDER_COMPANY => (new Pdlt\Controller\AdminPresentationController)->updateSliderCompany(),
		PAGE_ADMIN_DELETE_SLIDE_COMPANY => (new Pdlt\Controller\AdminPresentationController)->deleteSlideCompany(),
		PAGE_ADMIN_CREATE_SLIDE_COMPANY => (new Pdlt\Controller\AdminPresentationController)->createSlideCompany(),
		PAGE_ADMIN_UPDATE_MEMBERS => (new Pdlt\Controller\AdminTeamController)->updateMember(),
	};
	
	echo $result;
}

//	switch ($_POST['context'])
//	{
//		case PAGE_ADMIN_PRODUCTS:
//			echo (new Pdlt\Controller\AdminProductsController)->refreshProducts();
//			break;
//
//		case PAGE_ADMIN_MODIFY_PRODUCTS:
//			echo (new Pdlt\Controller\AdminProductsController)->modifyProduct();
//			break;
//
//		case PAGE_ADMIN_UPDATE_PRODUCT:
//			echo (new Pdlt\Controller\AdminProductsController)->updateProduct();
//			break;
//
//		case PAGE_ADMIN_CANCEL_PRODUCT:
//			echo (new Pdlt\Controller\AdminProductsController)->showProduct();
//			break;
//
//		case PAGE_ADMIN_DELETE_PRODUCT:
//			echo (new Pdlt\Controller\AdminProductsController)->deleteProduct();
//			break;
//
//		case PAGE_AJAX_SLIDER_PRODUCTS:
//			echo (new Pdlt\Controller\ProductController)->sliderProduct();
//			break;
//
//		case PAGE_ADMIN_UPDATE_PARTENAIRES:
//			echo(new Pdlt\Controller\AdminPartenairesController)->updatePartenaire();
//			break;
//
//		case PAGE_ADMIN_MODIFY_PARTENAIRES:
//			echo(new Pdlt\Controller\AdminPartenairesController)->modifyPartenaire();
//			break;
//
//		case PAGE_ADMIN_CANCEL_PARTENAIRE:
//			echo(new Pdlt\Controller\AdminPartenairesController)->showPartenaire();
//			break;
//
//		case ADMIN_DELETE_PARTENAIRE:
//			echo(new Pdlt\Controller\AdminPartenairesController)->deletePartenaire();
//			break;
//
//		case PAGE_ADMIN_PARTENAIRES:
//			echo(new Pdlt\Controller\AdminPartenairesController)->refreshPartenaires();
//			break;
//
//		case PAGE_ADMIN_MODIFY_PRESENTATION:
//			echo(new Pdlt\Controller\AdminPresentationController)->modifyPresentation();
//			break;
//
//		case PAGE_ADMIN_CANCEL_PRESENTATION:
//			echo(new Pdlt\Controller\AdminPresentationController)->showPresentation();
//			break;
//
//		case PAGE_ADMIN_UPDATE_PRESENTATION:
//			echo(new Pdlt\Controller\AdminPresentationController)->updatePresentation();
//			break;
//
//		case PAGE_ADMIN_MODIFY_SLIDER_COMPANY:
//			echo(new Pdlt\Controller\AdminPresentationController)->modifySliderCompany();
//			break;
//
//		case PAGE_ADMIN_CANCEL_SLIDER_COMPANY:
//			echo(new Pdlt\Controller\AdminPresentationController)->refreshSliderCompany();
//			break;
//
//		case PAGE_ADMIN_UPDATE_SLIDER_COMPANY:
//			echo(new Pdlt\Controller\AdminPresentationController)->updateSliderCompany();
//			break;
//
//		case PAGE_ADMIN_DELETE_SLIDE_COMPANY:
//			echo(new Pdlt\Controller\AdminPresentationController)->deleteSlideCompany();
//			break;
//
//		case PAGE_ADMIN_CREATE_SLIDE_COMPANY:
//			echo(new Pdlt\Controller\AdminPresentationController)->createSlideCompany();
//			break;
//
//	}

