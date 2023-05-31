<?php

namespace Pdlt\Repository;

use Pdlt\Manager\DbManager;
use Pdlt\Model\CompanySlider;

final class CompanySliderRepository extends AbstractRepository
{
	const TABLE = 'slider_company';
	const NB_ELT_PER_PAGE = 3;
	
	/**
	 * Récupérer les éléments du slider et les afficher
	 * @return array
	 */
	public static function findAll(): array
	{
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE . ';'
		);
		
		return static::extracted($oPdoStatement);
	}
	
	/**
	 * @param int $iId
	 * @return CompanySlider|null
	 */
	public static function find(int $iId): ?CompanySlider
	{
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'SELECT *
            FROM ' . static::TABLE .
		    ' WHERE id = :id';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
		$aDbCompanySlider = $oPdoStatement->fetch();
		
		return $aDbCompanySlider ? static::hydrate($aDbCompanySlider) : NULL;
	}
	
	/**
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
	 * @param array $aDbCompanySlider
	 * @return CompanySlider
	 */
	protected static function hydrate(array $aDbCompanySlider): CompanySlider
	{
		$oCompanySlider = new CompanySlider(
		    $aDbCompanySlider['url'],
		    $aDbCompanySlider['legend']
		);
		
		$oCompanySlider->setId($aDbCompanySlider['id']);
		$oCompanySlider->setStatus($aDbCompanySlider['status']);
		
		return $oCompanySlider;
	}

	
	/**
	 * @param array $aCriterias
	 * @return int|array
	 */
	protected static function countBy(array $aCriterias): int|array
	{
		//Récupère une variable extérieure
		$oPdo = DbManager::getInstance();
		
		// Configuration de la requête
		$sQuery = 'SELECT COUNT(*) AS nbCompanySlider FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if (count($aResult['where']) > 0) {
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		// Exécuter la requête
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aResult['params']);
		
		// On récupère le nombre d'articles
		$result = $oPdoStatement->fetch();
		
		$nbCompanySlider = (int)$result['nbCompanySlider'];
		
		return $nbCompanySlider;
		
	}
	
	/**
	 * @param $aCriterias
	 * @return array
	 */
	public static function findCriterias($aCriterias): array
	{
		// Tableau des conditions
		$aWhere = [];
		//Tableau des paramètres
		$aParams = [];
		// requête
		$sQuery = '';
		
		// 1. Si "magic-search" est défini
		if (!empty($aCriterias['magic-search'])) {
			$aWhere[] = ' ((`url` LIKE :magicsearch)
                        OR (`legend` LIKE :magicsearch))';
			$aParams[':magicsearch'] = '%' . $aCriterias['magic-search'] . '%';
		};
		
		// 2. Si "status" est défini
		if (!empty($aCriterias['status'])) {
			$aWhere[] = '(status = :status)';
			$aParams[':status'] = $aCriterias['status'];
		};
		
		// 3. Si "id" est défini
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
	
	
	public static function update(array $aParams)
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'UPDATE `'. self::TABLE .'` as s
			SET s.url = :url
			WHERE s.id = :id ;' ;
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
	}
	
	
}