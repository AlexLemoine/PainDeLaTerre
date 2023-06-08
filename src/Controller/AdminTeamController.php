<?php

namespace Pdlt\Controller;

use Pdlt\Repository\MemberRepository;
use Pdlt\Repository\TeamRepository;

class AdminTeamController extends AbstractController
{
	/**
	 * Afficher la vue admin_team
	 * pour la gestion du contenu Team et Member
	 * @return string
	 */
	public function manageTeam(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('admin_team.php',
		    [
			  'seo_title' => TITLE_ADMIN_TEAM,
			  'team' => TeamRepository::find(1),
			  'members' => MemberRepository::findAll()
		    ]);
	}
	
}

