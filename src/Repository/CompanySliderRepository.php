<?php

namespace Pdlt\Repository;

use Pdlt\Manager\DbManager;
use Pdlt\Model\CompanySlider;

final class CompanySliderRepository extends AbstractRepository
{
	const TABLE = 'slider_company';
	const NB_ELT_PER_PAGE = 3;
	
	public static function findAll(): array
	{
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE . ';'
		);
		
		return static::extracted($oPdoStatement);
	}
	
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
	
	
	protected static function hydrate(array $aDbCompanySlider): CompanySlider
	{
		$oCompanySlider = new CompanySlider(
		    $aDbCompanySlider['url'],
		    $aDbCompanySlider['legend']
		);
		
		$oCompanySlider->setStatus($aDbCompanySlider['status']);
		
		return $oCompanySlider;
	}
	
	
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
	
	
	
	
}