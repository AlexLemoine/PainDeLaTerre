<?php

namespace Pdlt\Repository;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Team;


final class TeamRepository extends AbstractRepository
{
	
	// *** CONSTANTES ***
	
	const TABLE = 'team';
	const NB_ELT_PER_PAGE = 20;
	
	
	// *** FONCTIONS ***
	
	
	/**
	 * Retourne l'équipe de la BDD
	 * @return array
	 */
	public static function findAll(): array
	{
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE
		);
		
		return static::extracted($oPdoStatement);
	}
	
	/**
	 * Retourne une équipe en fonction de son id
	 * @param int $iId
	 * @return Team|null
	 * @throws \Exception
	 */
	public static function find(int $iId): ?Team
	{
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'SELECT *
            FROM ' . static::TABLE .
		    ' WHERE team.id = :id';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
		$aDbTeam = $oPdoStatement->fetch();
		
		return $aDbTeam ? static::hydrate($aDbTeam) : NULL;
	}
	
	/**
	 * Retourne l'équipe' en BDD en fonction des critères donnés
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
		
		$sQuery .= ' ORDER BY `id`';
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
	 * Va créer une équipe selon les infos données
	 * @param array $aDbTeam
	 * @return Team
	 * @throws \Exception
	 */
	protected static function hydrate(array $aDbTeam): Team
	{
		$oTeam = new Team(
		    $aDbTeam['desc_resume'],
		    $aDbTeam['desc_origin'],
		    $aDbTeam['picture']);
		
		return $oTeam;
	}
	
	/**
	 * * Retourne le nombre d'équipes en BDD selon les critères
	 * @param array $aCriterias
	 * @return int|array
	 */
	protected static function countBy(array $aCriterias): int|array
	{
		//Récupère une variable extérieure
		$oPdo = DbManager::getInstance();
		
		// Configuration de la requête
		$sQuery = 'SELECT COUNT(*) AS nbTeam FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if (count($aResult['where']) > 0) {
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		// Exécuter la requête
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aResult['params']);
		
		// On récupère le nombre d'articles
		$result = $oPdoStatement->fetch();
		
		$nbTeam = (int)$result['nbTeam'];
		
		return $nbTeam;
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
		
		
		// 1. Si "magic-search" est défini
		if (!empty($aCriterias['magic-search'])) {
			$aWhere[] = ' ((`desc_resume` LIKE :magicsearch)
                        OR (`desc_origin` LIKE :magicsearch))';
			$aParams[':magicsearch'] = '%' . $aCriterias['magic-search'] . '%';
		}

		
		// 2. Si "id" est défini
		if (!empty($aCriterias['id'])) {
			$aWhere[] = '(id = :id)';
			$aParams[':id'] = $aCriterias['id'];
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
	 * Mettre à jour les textes de présentation et la photo d'équipe
	 * @param $aParams
	 * @return void
	 */
	public static function update($aParams): void
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'UPDATE `'. self::TABLE .'` as t
			SET t.desc_resume = :desc_resume,
			t.desc_origin = :desc_origin' ;
		
		if ($aParams[':picture']) {
			$sQuery .= ', t.picture = :picture';
		}
		
		$sQuery .= ' WHERE t.id = :id ;';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
	}
	
	
	
}