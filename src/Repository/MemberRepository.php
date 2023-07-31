<?php

namespace Pdlt\Repository;

use Exception;
use Pdlt\Manager\DbManager;
use Pdlt\Model\Member;

final class MemberRepository extends AbstractRepository
{
	
	// *** CONSTANTES ***
	
	const TABLE = 'member';
	const NB_ELT_PER_PAGE = 20;
	
	
	// *** FONCTIONS ***
	
	/**
	 * Retourne tous les membres en BDD
	 * @return array
	 */
	public static function findAll(): array
	{
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE . ' ORDER BY `id`'
		);
		
		return static::extracted($oPdoStatement);
	}
	
	/**
	 * Récupère un membre en BDD en fonction de on id
	 * @param int $iId
	 * @return Member|null
	 */
	public static function find(int $iId): ?Member
	{
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'SELECT *
            FROM ' . static::TABLE .
		    ' WHERE id = :id';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
		$aDbMember = $oPdoStatement->fetch();
		
		return $aDbMember ? static::hydrate($aDbMember) : NULL;
		
	}
	
	/**
	 * Retourne les membres en BDD en fonction des critères donnés
	 * @param array $aCriterias
	 * @param int $iOffset
	 * @param int $iNbElts
	 * @return array
	 */
	public static function findBy(array $aCriterias, int $iOffset = 0, int $iNbElts = self::NB_ELT_PER_PAGE): array
	{
		$oPdo = DbManager::getInstance();
		
		// Configuration de la requête
		$sQuery = 'SELECT * FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if (count($aResult['where']) > 0) {
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		if ($iOffset <= 0) {
			$iOffset = 0;
		};
		
		$sQuery .= ' `name`';
		$sQuery .= ' LIMIT ' . $iOffset . ' , ' . $iNbElts;
		
		// Exécuter la requête
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aResult['params']);
		
		
		// Parcours des résultats
		// et les récupère sous forme de tableau
		// avec les colonnes qui sont dans ma BDD
		return static::extracted($oPdoStatement);
		
	}
	
	/**
	 * Va créer un membre selon les infos données
	 * @param array $aDbMember
	 * @return Member
	 * @throws Exception
	 */
	protected static function hydrate(array $aDbMember): Member
	{
		$oMember = new Member(
		    $aDbMember['name'],
		    $aDbMember['position'],
		    $aDbMember['description'],
		    $aDbMember['picture']);
		
		$oMember->setId($aDbMember['id']);
		$oMember->setEntryDate(new \DateTime($aDbMember['entry_date']));
		
		return $oMember;
	}
	
	/**
	 * Retourne le nombre de membres en BDD selon les critères
	 * @param array $aCriterias
	 * @return int|array
	 */
	protected static function countBy(array $aCriterias): int|array
	{
		//Récupère une variable extérieure
		$oPdo = DbManager::getInstance();
		
		// Configuration de la requête
		$sQuery = 'SELECT COUNT(*) AS nbMembers FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if (count($aResult['where']) > 0) {
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		// Exécuter la requête
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aResult['params']);
		
		// On récupère le nombre d'articles
		$result = $oPdoStatement->fetch();
		
		$nbMembers = (int)$result['nbMembers'];
		
		return $nbMembers;
		
	}
	
	/**
	 * Crée le tableau de critères pour les donner aux requêtes
	 * @param array $aCriterias
	 * @return array
	 */
	private static function findCriterias(array $aCriterias): array
	{
		// Tableau des conditions
		$aWhere = [];
		//Tableau des paramètres
		$aParams = [];
		// requête
		$sQuery = '';
		
		// 1. Si name est défini dans $aCriterias, ajouter une clause WHERE
		if (!empty($aCriterias['name'])) {
			$aWhere[] = ' (name = :name)';
			$aParams[':name'] = $aCriterias['name'];
		};
		
		// 2. Si "magic-search" est défini
		if (!empty($aCriterias['magic-search'])) {
			$aWhere[] = ' ((`name` LIKE :magicsearch)
                        OR (`position` LIKE :magicsearch)
                        OR (`entry_date` LIKE :magicsearch))';
			$aParams[':magicsearch'] = '%' . $aCriterias['magic-search'] . '%';
		};
		
		if (count($aWhere) > 0) {
			$sQuery .= ' WHERE ' . implode(' AND ', $aWhere);
		};
		
		return [
		    'where' => $aWhere,
		    'params' => $aParams
		];
		
	}
	
	
	/**
	 * Créer un nouveau membre
	 * @param $aParams
	 * @return int|false
	 */
	public static function create($aParams): int|false
	{
		
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'INSERT INTO `'. self::TABLE .'`
				    (`name`,
				     `position`,
				     `description`,
				     `picture`,
				     `entry_date`)

				     VALUES
				     (:name,
				     :position,
				     :description,
				     :picture,
				     :entry_date);';
		

		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
		return $oPdo->lastInsertId();
		
	}
	
	/**
	 * Mettre à jour les infos d'un membre
	 * @param $aParams
	 * @return void
	 */
	public static function update($aParams): void
	{
		
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'UPDATE `'. self::TABLE .'` as m
			SET m.name = :name,
			m.position = :position,
			m.description = :description' ;
		
		if ($aParams[':picture']) {
			$sQuery .= ', m.picture = :picture';
		}
		
		$sQuery .= ', m.entry_date = :entry_date
			WHERE m.id = :id ;';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
	}
	
	/**
	 * Supprimer un membre de l'équipe
	 * @param $id
	 * @return void
	 */
	public static function delete($id): void
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'DELETE FROM `'. self::TABLE .'`
			WHERE id = :id;';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
	}
	
	
	
}
















