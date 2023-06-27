<?php

namespace Pdlt\Repository;

use Pdlt\Controller\AbstractController;
use Pdlt\Controller\AdminPartenairesController;
use Pdlt\Manager\DbManager;
use Pdlt\Model\Partenaires;

final class PartenairesRepository extends AbstractRepository
{
	
	const TABLE = 'partenaires';
	const NB_ELT_PER_PAGE = 20;
	
	
	// FONCTIONS
	
	/** Récupérer tous les partenaires sous forme de tableau contenant des objets
	 * @return array
	 */
	public static function findAll(): array
	{
		// Connexion avec BDD
		$oPdo = DbManager::getInstance();
		
		$oPdoStatement = $oPdo->query(
		    'SELECT *  FROM ' . static::TABLE . ' ORDER BY created_at'
		);
		
		return static::extracted($oPdoStatement);
		
	}
	
	
	/** Retourne un fournisseur en fonction de son id
	 *
	 */
	public static function find(int $iId): ?Partenaires
	{
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'SELECT *
            FROM ' . static::TABLE .
		    ' WHERE partenaires.id = :id';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $iId, \PDO::PARAM_INT);
		$oPdoStatement->execute();
		
		$aDbPartenaire = $oPdoStatement->fetch();
		
		return $aDbPartenaire ? static::hydrate($aDbPartenaire) : NULL;
		
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
		if(! empty($aCriterias['magic-search']))
		{
			$aWhere[] = ' ((`name` LIKE :magicsearch)
                        OR (`localisation` LIKE :magicsearch)
                        OR (`supply` LIKE :magicsearch)
                        OR (`description` LIKE :magicsearch))';
			$aParams[':magicsearch'] =  '%' . $aCriterias['magic-search'] . '%';
		};
		
		// 2. Si "id" est défini
		if(! empty($aCriterias['id']))
		{
			$aWhere[] = '(id = :id)';
			$aParams[':id'] = $aCriterias['id'];
		};
		
		// 3. Si "status" est défini
		if (!empty($aCriterias['status'])) {
			$aWhere[] = '(status = :status)';
			$aParams[':status'] = $aCriterias['status'];
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
	 * chercher des partenaires en fonction de critères
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
		
		
		$sQuery .= ' ORDER BY `localisation`,`name`';
		
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
	 * @param array $aDbPartenaires
	 * @return Partenaires
	 * @throws \Exception
	 */
	protected static function hydrate(array $aDbPartenaires): Partenaires
	{
		$oPartenaires =  new Partenaires(
		    $aDbPartenaires['name'],
		    $aDbPartenaires['description']);
		
		$oPartenaires->setId($aDbPartenaires['id']);
		$oPartenaires->setStatus($aDbPartenaires['status']);
		$oPartenaires->setLocalisation($aDbPartenaires['localisation']);
		$oPartenaires->setSupply($aDbPartenaires['supply']);
		$oPartenaires->setDescription($aDbPartenaires['description']);
		if(! empty($aDbPartenaires['picture']))
		{
			$oPartenaires->setPicture($aDbPartenaires['picture']);
		};
		if(! empty($aDbPartenaires['site']))
		{
			$oPartenaires->setSite($aDbPartenaires['site']);
		};
		$oPartenaires->setCreatedAt(new \DateTime($aDbPartenaires['created_at']));
		
		return $oPartenaires;
	}
	
	public static function countBy(array $aCriterias): int|array
	{
		//Récupère une variable extérieure
		$oPdo = DbManager::getInstance();
		
		// Configuration de la requête
		$sQuery='SELECT COUNT(*) AS nbPartenaires FROM ' . static::TABLE;
		
		
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
		
		$nbPartenaires = (int) $result['nbPartenaires'];
		
		return $nbPartenaires;
		
	}
	
	/**
	 * Met à jour le fournisseur
	 * @param $aParams
	 * @return void
	 */
	public static function update($aParams): void
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'UPDATE `partenaires` as p
			SET p.name = :name,
			    p.status = :status,
			    p.picture = :picture,
			    p.localisation = :localisation,
			    p.supply = :supply,
			    p.description = :description,
			    p.site = :site
			WHERE p.id = :id ;' ;
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
	}
	
	/**
	 * Crée un partenaire en BDD
	 * @param $aParams
	 * @return int
	 */
	public static function create($aParams): int
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'INSERT INTO `partenaires`
				    (
				     `name`,
				     `status`,
				     `picture`,
				     `localisation`,
				     `supply`,
				     `description`,
				     `site`)

				     VALUES
				     (
				     :name,
				      :status,
				     :picture,
				     :localisation,
				     :supply,
				    	:description,
				      :site);';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->execute($aParams);
		
		return $oPdo->lastInsertId();
		
	}
	
	/**
	 * Supprimer un partenaire
	 * @param $id
	 * @return void
	 */
	public static function delete($id): void
	{
		// Lien avec la BDD
		$oPdo = DbManager::getInstance();
		
		$sQuery = 'DELETE FROM '. PartenairesRepository::TABLE .'
       				WHERE id = :id;';
		
		$oPdoStatement = $oPdo->prepare($sQuery);
		$oPdoStatement->bindValue(':id', $id, \PDO::PARAM_INT);
		$oPdoStatement->execute();
	}
	
	
	
}