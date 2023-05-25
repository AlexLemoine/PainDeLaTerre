<?php

namespace Pdlt\Repository;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Presentation;

final class PresentationRepository extends AbstractRepository
{
	const TABLE = 'presentation';
	const NB_ELT_PER_PAGE = 20;
	
	
	/**
	 * @return array
	 */
	public static function findAll(): array
	{
		// Connexion avec BDD
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE . ';'
		);
		
		return static::extracted($oPdoStatement);
	}
	
	/**
	 * @param int $iId
	 * @return Presentation|null
	 */
	public static function find(int $iId): ?Presentation
	{
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'SELECT *
            FROM ' . static::TABLE .
		    ' WHERE presentation.id = :id';
		
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
		$aDbPresentation = $oPdoStatement->fetch();
		
		return $aDbPresentation ? static::hydrate($aDbPresentation) : NULL;
		
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
		
		
		// 1. Si "id" est défini
		if(! empty($aCriterias['id']))
		{
			$aWhere[] = '(id = :id)';
			$aParams[':id'] = $aCriterias['id'];
		};
		
		// 2. Si "theme" est défini
		if(! empty($aCriterias['theme']))
		{
			$aWhere[] = '(theme = :theme)';
			$aParams[':theme'] = $aCriterias['theme'];
		};
		
		// 3. Si "magic-search" est défini
		if(! empty($aCriterias['magic-search']))
		{
			$aWhere[] = ' ((`theme` LIKE :magicsearch)
                        OR (`text` LIKE :magicsearch))';
			$aParams[':magicsearch'] =  '%' . $aCriterias['magic-search'] . '%';
		};
		
		
		if(count($aWhere)>0)
		{
			$sQuery .= ' WHERE ' . implode(' AND ', $aWhere);
		};
		
		return [
		    'where' => $aWhere,
		    'params' => $aParams
		];
		
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
		$sQuery='SELECT * FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if(count($aResult['where'])>0)
		{
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		if($iOffset <=0)
		{
			$iOffset = 0;
		};
		
		$sQuery .= ' ORDER BY `theme`';
		
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
	 * @param array $aDbPresentation
	 * @return Presentation
	 */
	protected static function hydrate(array $aDbPresentation): Presentation
	{
		$oPresentation =  new Presentation(
		    $aDbPresentation['theme'],
		    $aDbPresentation['text']);
		
		$oPresentation->setId($aDbPresentation['id']);
		$oPresentation->setTheme($aDbPresentation['theme']);
		$oPresentation->setText($aDbPresentation['text']);
		
		return $oPresentation;
		
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
		$sQuery='SELECT COUNT(*) AS nbPresentation FROM ' . static::TABLE;
		
		$aResult = self::findCriterias($aCriterias);
		
		if(count($aResult['where'])>0)
		{
			$sQuery .= ' WHERE ' . implode(' AND ', $aResult['where']);
		};
		
		// Exécuter la requête
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aResult['params']);
		
		// On récupère le nombre d'articles
		$result = $oPdoStatement->fetch();
		
		$nbPresentation =  (int) $result['nbPresentation'];
		
		return $nbPresentation;
		
	}
	
	public static function update($aParams): void
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'UPDATE `presentation` as p
			SET p.text = :text
			WHERE p.id = :id ;' ;
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
	}
	
}