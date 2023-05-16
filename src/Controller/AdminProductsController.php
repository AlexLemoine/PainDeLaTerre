<?php

namespace Pdlt\Controller;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Product;
use Pdlt\Repository\ProductCategoryRepository;
use Pdlt\Repository\ProductFrequencyRepository;
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
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('admin_products.php',
		[
		    'seo_title' => TITLE_ADMIN_PRODUCTS,
			'products' => ProductRepository::findAll(),
			'categories' => ProductCategoryRepository::findAll(),
			'frequencies' => ProductFrequencyRepository::findAll(),
		]);
		
	}
	
	
	
	/**
	 * Affiche la vue d'un produit si on clique sur le bouton Cancel
	 * en mode modification de produit
	 * @return string
	 */
	public function showProduct():string
	{
		// TODO Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$product = ProductRepository::find($id);
			
			// Si le produit n'existe pas, redirection vers page d'accueil
			if(!$product instanceof Product)
			{
				$this->redirectAndDie();
			}
			
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_product.php',[
			    'oProduct' => $product,
			],
			    true
			);
		} else {
			return $this->render('_admin_product.php',[
			    'oProduct' => new Product(),
			],
			    true
			);
		}
		
	}
	
	/**
	 * Fonction appelée en AJAX
	 * Objectif : retourner du code HTML partiel
	 * @return string
	 *
	 **/
	public function refreshProducts(): string
	{
		// TODO Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
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
	
	/**
	 * Fonction appelée en ajax
	 * Permet de modifier un produit sélectionné
	 * @return string
	 */
	public function modifyProduct():string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$product = ProductRepository::find($id);
			
			// Si le produit n'existe pas, redirection vers page d'accueil
			if(!$product instanceof Product)
			{
				$this->redirectAndDie();
			}
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_modify_product.php',[
			    'product' => $product,
			    'categories' => ProductCategoryRepository::findAll(),
			    'frequencies' => ProductFrequencyRepository::findAll(),
			],
			    true
			);
		}
		
		// Renvoi de la vue partielle de la card en mode formulaire
		return $this->render('admin_products.php',[
		    'products' => ProductRepository::findAll(),
		    'categories' => ProductCategoryRepository::findAll(),
		    'frequencies' => ProductFrequencyRepository::findAll(),
		],
		    true
		);

	}
	
	/**
	 * Mettre à jour le produit en BDD
	 * Retourner la vue partielle du produit modifié en AJAX
	 * @return string
	 */
	public function updateProduct():string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
//
//		var_dump($_POST);
		
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		// Récupération de l'id de la card sélectionnée
		$id = $_POST['id'];
		
		// TODO Ajouter fonction save() dans Repo
		// Gérer la soumission du formulaire
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'name' => strip_tags($_POST['name']),
		    'category' => strip_tags($_POST['category']),
		    'ingredients' => strip_tags($_POST['ingredients']),
		    'description' => strip_tags($_POST['description']),
		    'status' => strip_tags($_POST['status']),
		    'picture' => strip_tags($_FILES['picture']['tmp_name']),
		    'picture_secondary' => strip_tags($_FILES['picture_secondary']['tmp_name']),
		    'frequency' => strip_tags($_POST['frequency']),
		];
		
		if(file_exists($aCriterias['picture'])) {
			// Récupération des informations sur l'image
			$aPictureInfo = getimagesize($_FILES['picture']['tmp_name']);
			
			// Vérification que le fichier est bien une image
			if($aPictureInfo) {
				// Nettoyage du nom de fichier et ajout de l'extension
				$sFileNameNew = uniqid() . '.' . pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
				$sFilePathNew = DIR_UPLOADS . DIRECTORY_SEPARATOR . $sFileNameNew;
				
				// Déplacement du fichier téléchargé vers le dossier des uploads
				if (move_uploaded_file($_FILES['picture']['tmp_name'], $sFilePathNew)) {
					// Le fichier a été correctement déplacé, on l'ajoute aux critères de mise à jour
					$aCriterias['picture'] = basename($sFilePathNew);
				}
			}
		}
		
		if(file_exists($aCriterias['picture_secondary'])) {
			// Récupération des informations sur l'image
			$aPictureInfo2 = getimagesize($_FILES['picture_secondary']['tmp_name']);
			
			// Vérification que le fichier est bien une image
			if($aPictureInfo2) {
				// Nettoyage du nom de fichier et ajout de l'extension
				$sFileNameNew2 = uniqid() . '.' . pathinfo($_FILES['picture_secondary']['name'], PATHINFO_EXTENSION);
				$sFilePathNew2 = DIR_UPLOADS . DIRECTORY_SEPARATOR . $sFileNameNew2;
				
				// Déplacement du fichier téléchargé vers le dossier des uploads
				if (move_uploaded_file($_FILES['picture_secondary']['tmp_name'], $sFilePathNew2)) {
					// Le fichier a été correctement déplacé, on l'ajoute aux critères de mise à jour
					$aCriterias['picture_secondary'] = basename($sFilePathNew2);
				}
			}
		}
		
		$aParams = [
		    ':category' => $aCriterias['category'],
		    ':name' => $aCriterias['name'],
		    ':ingredients' => $aCriterias['ingredients'],
		    ':description' => $aCriterias['description'],
		    ':status' => $aCriterias['status'],
		    ':picture' => $aCriterias['picture'],
		    ':picture_secondary' => $aCriterias['picture_secondary'],
		    ':frequency' => $aCriterias['frequency']
		];
		
		// Si l'id existe
		// update en BDD
		if (isset($id)){
			
			$aParams[':id'] = $id;
			
			$product = ProductRepository::find($id);
			
			// Si le produit n'existe pas, redirection vers page d'accueil
			if(!$product instanceof Product)
			{
				$this->redirectAndDie();
			}
			
			$sQuery = 'UPDATE `product` as p
			SET p.productCategory_id = :category,
			    p.name = :name,
			    p.ingredients = :ingredients,
			    p.description = :description,
			    p.status = :status,
			    p.picture = :picture,
			    p.picture_secondary = :picture_secondary,
			    p.frequency = :frequency
			WHERE p.id = :id ;' ;
		} else {
			
			// Si pas d'id,
			// création du produit en BDD
			
			$sQuery = 'INSERT INTO `product`
				    (`productCategory_id`,
				     `name`,
				     `ingredients`,
				     `description`,
				     `status`,
				     `picture`,
				     `picture_secondary`,
				     `frequency`)

				     VALUES
				     (:category,
				     :name,
				     :ingredients,
				     :description,
				     :status,
				    	:picture,
				      :picture_secondary,
				      :frequency);';
		
		}
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
		if (!isset($id)){
			$id = $oPdo->lastInsertId();
		}

		// render (vue partielle texte)
		return $this->render('_admin_product.php',[
		    // Rafraîchir les données du produit modifié
		    'oProduct' => ProductRepository::find($id),
		],
		    true
		);
		
	}
	
	public function deleteProduct(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		// Seulement si isToDelete
		if($_POST['isToDelete'] === 'yes'){
			
			// Récupération de l'id de la card sélectionnée
			$id = $_POST['id'];
			$product = ProductRepository::find($id);
			
			// Si le produit n'existe pas, redirection vers page d'accueil
			if(!$product instanceof Product)
			{
				$this->redirectAndDie();
			}
			
			$sQuery = 'DELETE FROM '. ProductRepository::TABLE .'
       				WHERE id = :id;';
			
			
			$oPdoStatement = $oPdo->prepare($sQuery);
			$oPdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
			$oPdoStatement->execute();
		}
		
		// render (vue partielle texte)
		return $this->render('_admin_products.php',[
		    'products' => ProductRepository::findAll(),
		],
		    true
		);
		
		
	}
	

	
}