<?php

namespace Pdlt\Controller;

use Pdlt\Repository\ProductCategoryRepository;
use Pdlt\Repository\ProductRepository;

class AdminProductsController extends AbstractController
{
	/**
	 * Afficher liste des produits
	 *
	 * @return string
	 */
	public function manageProducts(): string
	{
		return $this->render('admin_products.php',
		[
		    'seo_title' => TITLE_ADMIN_PRODUCTS,
			'products' => ProductRepository::findAll(),
			'categories' => ProductCategoryRepository::findAll(),
		]);
		
	}
	
	/**
	 * Fonction appelée en AJAX
	 * Objectif : retourner du code HTML partiel
	 * @return string
	 *
	 **/
	public function refreshProducts(): string
	{
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'magic-search' => strip_tags($_POST['magic-search']),
		    'category' => strip_tags($_POST['category']),
		    'status' => strip_tags($_POST['status']),
		];
		
		// Stockage en session des critères (pour pagination ajax par ex)
		$_SESSION['criterias'] = $aCriterias;
		
		// 1. Calculer l'offset
		$iPage = ($_POST['page'] ?? 1);
		$iNbEltsPerPage = ProductRepository::NB_ELT_PER_PAGE;
		$iOffset = ($iPage - 1) * $iNbEltsPerPage;
		
		$aParams =  [
		    'products' => ProductRepository::findBy($aCriterias, $iOffset, $iNbEltsPerPage),
		    'currentPage' => $iPage,
		    'nb_results' => ProductRepository::countBy($aCriterias),
		    'nb_results_per_page' => $iNbEltsPerPage,
		];
		
		// 2. Récupérer les produits et les renvoyer à la vue HTML
		return $this->render('_admin_products.php', $aParams, true);
	}
	
}