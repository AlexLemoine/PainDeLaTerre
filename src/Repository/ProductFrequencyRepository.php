<?php
namespace Pdlt\Repository;
use Pdlt\Manager\DbManager;
use Pdlt\Model\ProductFrequency;


final class ProductFrequencyRepository extends AbstractRepository
{
    const TABLE = 'frequency';


    /**
     * @return array
     */
    public static function findAll(): array
    {
        $oPdo = DbManager::getInstance();

        $oPdoStatement = $oPdo->query(
            'SELECT * FROM ' . static::TABLE
        );

        return static::extracted($oPdoStatement);
    }
	
	/**
	 * @param int $iId
	 * @return ProductFrequency|null
	 */
    public static function find(int $iId): ?ProductFrequency
    {
        $oPdo = DbManager::getInstance();

        $sQuery = 'SELECT * FROM '. static::TABLE . ' WHERE id = :id';

        $oPdoStatement = $oPdo->prepare($sQuery);
        $oPdoStatement->bindValue('id',$iId,\PDO::PARAM_INT);
        $oPdoStatement->execute();

        $aDbFrequency = $oPdoStatement->fetch();

        return $aDbFrequency ? static::hydrate($aDbFrequency) : NULL;

    }

    /**
     * @param $aCriterias
     * @return array
     */
    public static function findBy(array $aCriterias, int $iOffset = 0, int $iNbElts = self::NB_ELT_PER_PAGE): array
    {
        //Récupère une variable extérieure
        $oPdo = DbManager::getInstance();

        // Configuration de la requête
        $sQuery='SELECT * FROM ' . static::TABLE .' ';

        // Requêtes personnalisées

        // Tableau des conditions
        $aWhere = [];
        //Tableau des paramètres
        $aParams = [];

        // 1. Si magic-search définie dans $aCriterias, ajouter une clause WHERE
        if(! empty($aCriterias['magic-search']))
        {
            $aWhere[] = ' ((`name` LIKE :magicsearch))';
            $aParams[':magicsearch'] =  '%' . $aCriterias['magic-search'] . '%';
        };

        if(count($aWhere)>0)
        {
            $sQuery .= ' WHERE ' . implode(' AND ', $aWhere);
        };

        // Exécuter la requête
        $oPdoStatement = $oPdo->prepare($sQuery);
        $oPdoStatement->execute($aParams);

        return static::extracted($oPdoStatement);

    }
	
	
	/**
	 * @param array $aDbFrequency
	 * @return ProductFrequency
	 */
    protected static function hydrate(array $aDbFrequency): ProductFrequency
    {
        $oFrequency = new ProductFrequency($aDbFrequency['designation']);
	    $oFrequency->setId($aDbFrequency['id']);

        return $oFrequency;
    }


    protected static function countBy(array $aCriterias): int|array
    {
        $nbCat = '';
        return $nbCat;
    }
}