<?php

namespace Pdlt\Controller;

use Pdlt\Model\CompanySlider;
use Pdlt\Model\Presentation;
use Pdlt\Repository\CompanySliderRepository;
use Pdlt\Repository\PresentationRepository;

class AdminPresentationController extends AbstractController
{
	
	public function managePresentation(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		
		return $this->render('admin_presentation.php',
		    [
			  'seo_title' => TITLE_ADMIN_PRESENTATION,
			  'presentation' => PresentationRepository::findAll(),
			    'sliderCompany' => CompanySliderRepository::findAll(),
		    ]);
		
	}
	
	public function modifyPresentation()
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$presentation = PresentationRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if (!$presentation instanceof Presentation) {
				$this->redirectAndDie();
			}
			
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_modify_presentation.php', [
			    'presentation' => $presentation,
			],
			    true
			);
		}
	}
	
	public function showPresentation()
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id de la card sélectionnée
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$presentation = PresentationRepository::find($id);
			
			
			// Si la presentation n'existe pas, redirection vers page d'accueil
			if (!$presentation instanceof Presentation) {
				$this->redirectAndDie();
			}
			
			// Renvoi de la vue partielle de la card en mode formulaire
			return $this->render('_admin_presentation.php',[
			    'oPresentation' => $presentation,
			],
			    true
			);
		} else {
			return $this->render('_admin_presentation.php',[
			    'oPresentation' => new Presentation(),
			],
			    true
			);
		}
		
	}
	
	public function updatePresentation()
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		$id = NULL;
		
		// Récupération de l'id du texte de présentation sélectionné
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		};
		
		// Gérer la soumission du formulaire
		// Récupération (+ nettoyage des données POST)
		$aParams = [
		    ':text' => strip_tags($_POST['text']),
		];
		
		// Si l'id existe, mise à jour du texte de présentation en BDD
		if (isset($id)){
			
			$presentation = PresentationRepository::find($id);
			
			// Si la présentation n'existe pas, redirection vers page d'accueil
			if (!$presentation instanceof Presentation) {
				$this->redirectAndDie();
			}
			
			$aParams[':id'] = $id;
			PresentationRepository::update($aParams);
			
		} else {
			$this->redirectAndDie();
		}
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_presentation.php',[
			// Rafraîchir les données du texte modifié
		    'oPresentation' => PresentationRepository::find($id),
		],
		    true
		);
		
	}
	
	/**
	 * Permettre la modification du slider d'images "savoir-faire"
	 * @return string
	 */
	public function modifySliderCompany(): string
	{
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_modify_slider_company.php',[
			// Rafraîchir les données du texte modifié
		    'oSliderCompany' => CompanySliderRepository::findAll(),
		],
		    true
		);
		
	}
	
	/**
	 * Rafraîchir la vue en Ajax
	 */
	public function refreshSliderCompany(): string
	{
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_companySliders.php',[
			// Rafraîchir les données du texte modifié
		    'sliderCompany' => CompanySliderRepository::findAll(),
		],
		    true
		);
		
	}
	
	
	/**
	 * Mettre à jour les images du sliderCompany en BDD
	 * Les retourner en vue partielle appelée en Ajax
	 */
	public function updateSliderCompany(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Préparer un tableau pour stocker les mises à jour
		$updates = [];
		
		// Parcourir les données POST pour récupérer les objets
		foreach ($_POST as $key => $value) {
			if (str_starts_with($key, 'id')) {
				$id = $value;
				$urlKey = 'url' . substr($key, 2);
				if (isset($_POST[$urlKey])) {
					$url = $_POST[$urlKey];
					$updates[] = ['id' => $id, 'url' => $url];
				}
			}
		}
		
		// Parcourir les mises à jour et effectuer les opérations nécessaires
		foreach ($updates as $update) {
			$id = $update['id'];
			$url = $update['url'];
			
			// Vérifier si un fichier a été envoyé pour cette URL
			if (isset($_FILES['url' . $id]) && $_FILES['url' . $id]['error'] === UPLOAD_ERR_OK) {
				// Récupération des informations sur l'image
				$aPictureInfo = getimagesize($_FILES['url' . $id]['tmp_name']);
				
				// Vérification que le fichier est bien une image
				if ($aPictureInfo) {
					// Nettoyage du nom de fichier et ajout de l'extension
					$sFileNameNew = uniqid() . '.' . pathinfo($_FILES['url' . $id]['name'], PATHINFO_EXTENSION);
					$sFilePathNew = DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR . $sFileNameNew;
					
					// Déplacement du fichier téléchargé vers le dossier des uploads
					if (move_uploaded_file($_FILES['url' . $id]['tmp_name'], $sFilePathNew)) {
						// Le fichier a été correctement déplacé, on met à jour l'URL
						$url = basename($sFilePathNew);
					}
				}
			}
			
			// Mettre à jour l'objet en base de données avec les nouvelles valeurs
			$aParams = [
			    ':id' => $id,
			    ':url' => $url,
			];
			
			// Si l'id existe, mise à jour du partenaire en BDD
			$slider = CompanySliderRepository::find($id);
			
			// Si le partenaire n'existe pas, redirection vers la page d'accueil
			if (!$slider instanceof CompanySlider) {
				$this->redirectAndDie();
			}
			
			CompanySliderRepository::update($aParams);
		}
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_admin_companySliders.php',[
			// Rafraîchir les données du produit modifié
		    'sliderCompany' => CompanySliderRepository::findAll(),
		],
		    true
		);
		
		
	}
	
	
}