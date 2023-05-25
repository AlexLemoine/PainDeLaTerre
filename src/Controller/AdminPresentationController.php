<?php

namespace Pdlt\Controller;

use Pdlt\Model\Presentation;
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
	
}