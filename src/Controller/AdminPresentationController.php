<?php

namespace Pdlt\Controller;

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
	public function updateSliderCompany(): string
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
	
}