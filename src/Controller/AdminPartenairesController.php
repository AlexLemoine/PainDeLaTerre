<?php

namespace Pdlt\Controller;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Partenaires;
use Pdlt\Repository\PartenairesRepository;

class AdminPartenairesController extends AbstractController
{
	
	public function managePartenaires(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('admin_partenaires.php',
		    [
			  'seo_title' => TITLE_ADMIN_PARTENAIRES,
			  'partenaires' => PartenairesRepository::findAll(),
		    ]);

	}
	
	
	public function updatePartenaire(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id du partenaire sélectionné
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		};
		
		// Gérer la soumission du formulaire
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'name' => strip_tags($_POST['name']),
		    'status' => strip_tags($_POST['status']),
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
		    ':status' => $aCriterias['status'],
		    ':picture' => $aCriterias['picture'],
		    ':localisation' => $aCriterias['localisation'],
		    ':supply' => $aCriterias['supply'],
		    ':description' => $aCriterias['description'],
		    ':site' => $aCriterias['site'],
		];
		
		// Si l'id existe, mise à jour du partenaire en BDD
		if (isset($id)){
			
			$partenaire = PartenairesRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if (!$partenaire instanceof Partenaires) {
				$this->redirectAndDie();
			}
			
			$aParams[':id'] = $id;
			PartenairesRepository::update($aParams);

		} else {

			// Si pas d'id, création du partenaire en BDD
			$id = PartenairesRepository::create($aParams);

		}
		
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_partenaire.php',[
			// Rafraîchir les données du produit modifié
		    'oPartenaire' => PartenairesRepository::find($id),
		],
		    true
		);
		
	}
	
	/**
	 * Fonction appelée en Ajax
	 * Permet de modifier un partenaire existant
	 * @return string
	 */
	public function modifyPartenaire(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$partenaire = PartenairesRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if (!$partenaire instanceof Partenaires) {
				$this->redirectAndDie();
			}
			
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_modify_partenaires.php', [
			    'partenaire' => $partenaire,
			],
			    true
			);
		}
		
		// Renvoi de la vue partielle de la card en mode formulaire
		return $this->render('admin_partenaires.php',[
		    'partenaires' => PartenairesRepository::findAll(),
		],
		    true
		);
		
	}
	
	/**
	 * Affiche la vue d'un partenaire si on clique sur le bouton Cancel
	 * En mode modification de partenaire
	 * @return string
	 */
	public function showPartenaire(): string
	{
		
		// TODO Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$partenaire = PartenairesRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if (!$partenaire instanceof Partenaires) {
				$this->redirectAndDie();
			}
			
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_partenaire.php',[
			    'oPartenaire' => $partenaire,
			],
			    true
			);
		} else {
			return $this->render('_admin_partenaire.php',[
			    'oPartenaire' => new Partenaires(),
			],
			    true
			);
		}
		
	}
	
	/**
	 * Supprimer un partenaire en BDD
	 * @return string
	 */
	public function deletePartenaire(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Seulement si isToDelete
		if($_POST['isToDelete'] === 'yes'){
			
			// Récupération de l'id de la card sélectionnée
			$id = $_POST['id'];
			$partenaire = PartenairesRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if(!$partenaire instanceof Partenaires){
				$this->redirectAndDie();
			}
			PartenairesRepository::delete($id);
		}
		
		return $this->render('_admin_partenaires.php',[
		    'partenaires' => PartenairesRepository::findAll(),
		],
		    true
		);
		
	}
	
	public function refreshPartenaires(): string
	{
		// TODO Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'magic-search' => strip_tags($_POST['magic-search']),
		    'status' => strip_tags($_POST['status']),
		];
		
		// Stockage en session des critères (pour pagination ajax par ex)
		$_SESSION['criterias'] = $aCriterias;
		
		// 1. Calculer l'offset
		$iPage = ($_POST['page'] ?? 1);
		$iNbEltsPerPage = PartenairesRepository::NB_ELT_PER_PAGE;
		$iOffset = ($iPage - 1) * $iNbEltsPerPage;
		
		$aParams =  [
		    'partenaires' => PartenairesRepository::findBy($aCriterias, $iOffset, $iNbEltsPerPage),
		    'currentPage' => $iPage,
		    'nb_results' => PartenairesRepository::countBy($aCriterias),
		    'nb_results_per_page' => $iNbEltsPerPage,
		];
		
		
		// 2. Récupérer les partenaires et les renvoyer à la vue HTML
		return $this->render('_admin_partenaires.php', $aParams, true);
		
	}
	

}