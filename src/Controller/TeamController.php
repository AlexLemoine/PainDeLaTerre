<?php

namespace Pdlt\Controller;

use Exception;
use Pdlt\Repository\MemberRepository;
use Pdlt\Repository\TeamRepository;

class TeamController extends AbstractController
{
	/**
	 * Charger la vue "team.php"
	 * et afficher les données transmises en paramètres
	 * @return string
	 * @throws Exception
	 */
	public function team(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('team.php',
		    [
			  'seo_title' => TITLE_TEAM,
			  'team' => TeamRepository::find(1),
			  'members' => MemberRepository::findAll(),
		    ]);
		
	}
	
}

