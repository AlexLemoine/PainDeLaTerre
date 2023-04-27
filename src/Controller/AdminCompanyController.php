<?php

namespace Pdlt\Controller;

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
	
	
}