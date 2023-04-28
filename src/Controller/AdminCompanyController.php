<?php

namespace Pdlt\Controller;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Partenaires;
use Pdlt\Repository\PartenairesRepository;

class AdminCompanyController extends AbstractController
{
	
	public function manageCompany(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('admin_company.php',
		    [
			  'seo_title' => TITLE_ADMIN_COMPANY,
			  'partenaires' => PartenairesRepository::findAll(),
		    ]);
		
	}
	
	
	public function updatePartenaire(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
//		var_dump($_POST);
		
		// Récupération de l'id du partenaire sélectionné
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		};

		
		// TODO Ajouter fonction save() dans Repo
		// Gérer la soumission du formulaire
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'name' => strip_tags($_POST['name']),
		    'picture' => strip_tags($_FILES['picture']['tmp_name']),
		    'localisation' => strip_tags($_POST['localisation']),
		    'supply' => strip_tags($_POST['supply']),
		    'description' => strip_tags($_POST['description']),
		    'site' => strip_tags($_POST['site']),
		];
		
		if($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
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
		
		$aParams = [
		    ':name' => $aCriterias['name'],
		    ':picture' => $aCriterias['picture'],
		    ':localisation' => $aCriterias['localisation'],
		    ':supply' => $aCriterias['supply'],
		    ':description' => $aCriterias['description'],
		    ':site' => $aCriterias['site'],
		];
		
		// Si l'id existe
		// update en BDD
		if (isset($id)){
			
			$aParams[':id'] = $id;
			
			$partenaire = PartenairesRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if(!$partenaire instanceof Partenaires)
			{
				$this->redirectAndDie();
			}
			
			$sQuery = 'UPDATE `partenaires` as p
			SET p.name = :name,
			    p.picture = :picture,
			    p.localisation = :localisation,
			    p.supply = :supply,
			    p.description = :description,
			    p.site = :site,
			WHERE p.id = :id ;' ;
		} else {
			
			// Si pas d'id,
			// création du partenaire en BDD
			
			$sQuery = 'INSERT INTO `partenaires`
				    (
				     `name`,
				     `picture`,
				     `localisation`,
				     `supply`,
				     `description`,
				     `site`)

				     VALUES
				     (
				     :name,
				     :picture,
				     :localisation,
				     :supply,
				    	:description,
				      :site);';
			
		}
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
		if (!isset($id)){
			$id = $oPdo->lastInsertId();
		}
		
		
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_partenaire.php',[
			// Rafraîchir les données du produit modifié
		    'oPartenaire' => PartenairesRepository::find($id),
		],
		    true
		);
		
		
	}
	
	
}