<?php

namespace Pdlt\Controller;

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
	
}