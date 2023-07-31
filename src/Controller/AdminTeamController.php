<?php

namespace Pdlt\Controller;

use Pdlt\Model\Member;
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
		// TODO  - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		return $this->render('admin_team.php',
		    [
			  'seo_title' => TITLE_ADMIN_TEAM,
			  'team' => TeamRepository::find(1),
			  'members' => MemberRepository::findAll()
		    ]);
	}
	
	/**
	 * @throws \Exception
	 */
	public function updateMember()
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		// Récupération de l'id du membre sélectionné
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		};
		
		// Gérer la soumission du formulaire
		// Récupération (+ nettoyage des données POST)
		$aCriterias = [
		    'picture' => strip_tags($_FILES['picture']['tmp_name']),
		    'name' => strip_tags($_POST['name']),
		    'position' => strip_tags($_POST['position']),
		    'description' => strip_tags($_POST['description']),
		    'entry_date' => strip_tags($_POST['entry_date']),
		];
		
		if($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
			// Récupération des informations sur l'image
			$aPictureInfo = getimagesize($_FILES['picture']['tmp_name']);
			
			// Vérification que le fichier est bien une image
			if($aPictureInfo) {
				// Nettoyage du nom de fichier et ajout de l'extension
				$sFileNameNew = uniqid() . '.' . pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
				$sFilePathNew = DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $sFileNameNew;
				
				// Déplacement du fichier téléchargé vers le dossier des uploads
				if (move_uploaded_file($_FILES['picture']['tmp_name'], $sFilePathNew)) {
					// Le fichier a été correctement déplacé, on l'ajoute aux critères de mise à jour
					$aCriterias['picture'] = basename($sFilePathNew);
				}
			}
		}
		
		$aParams = [
		    ':name' => $aCriterias['name'],
		    ':position' => $aCriterias['position'],
		    ':picture' => $aCriterias['picture'],
		    ':entry_date' => $aCriterias['entry_date'],
		    ':description' => $aCriterias['description'],
		];
		
		// Si l'id existe, mise à jour du membre en BDD
		if (isset($id)){
			
			$member = MemberRepository::find($id);
			
			// Si le membre n'existe pas, redirection vers page d'accueil
			if (!$member instanceof Member) {
				$this->redirectAndDie();
			}
			
			$aParams[':id'] = $id;
			MemberRepository::update($aParams);
			
		} else {
			
			// Si pas d'id, création du membre en BDD
			$id = MemberRepository::create($aParams);
			
		}
		
		// render pour rafraîchir ma vue (vue partielle texte)
		return $this->render('_member.php',[
			// Rafraîchir les données du produit modifié
		    'oMember' => MemberRepository::find($id),
		],
		    true
		);
		
	}
	
	public function refreshMember()
	{
		// TODO Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		$members = MemberRepository::findAll();
		
		return $this->render('_admin_team_members.php', [
		    'members' => $members,
		], true);
		
	}
	
	/**
	 * Supprimer un membre
	 * @return string
	 */
	public function deleteMember(): string
	{
		// TODO - Sécuriser en s'assurant que le user est bien administrateur
		// if($_SESSION['user']['role'] === ROLE_ADMIN)
		
		
		// Seulement si isToDelete
		if($_POST['isToDelete'] == 'yes'){
			
			$_SESSION['delete0'] = 'delete in progress';
			
			// Récupération de l'id de la card sélectionnée
			$id = $_POST['id'];
			$member = MemberRepository::find($id);
			$_SESSION['member'] = $member;
			
			// Si le partenaire n'existe pas, redirection vers page d'accueil
			if(!$member instanceof Member){
				$this->redirectAndDie();
				$_SESSION['redirect'] = 'redirectAndDie pb';
			}
			MemberRepository::delete($id);
			$_SESSION['delete1'] = 'ok';
			
			$_SESSION['post1'] = $_POST;
		}
		
		$_SESSION['delete2'] = 'ok';
		
		$_SESSION['post2'] = $_POST;
		
		return $this->render('_admin_team_members.php',[
		    'members' => MemberRepository::findAll(),
		],
		    true
		);
		
	}
	
}

