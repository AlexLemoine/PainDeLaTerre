<?php

namespace Pdlt\Repository;

use Pdlt\Manager\DbManager;
use Pdlt\Model\Product;
use Pdlt\Model\ProductFrequency;


final class ProductRepository extends AbstractRepository
{
    const TABLE = 'product';
    const NB_ELT_PER_PAGE = 15;


    // FONCTIONS

    /**
     * Récupérer les produits sous forme d'objet et les afficher
     * @return array
     */
    public static function findAll(): array
    {
        $oPdo = DbManager::getInstance();

        $oPdoStatement = $oPdo->query(
            'SELECT *  FROM ' . static::TABLE . ' ORDER BY productCategory_id'
        );

        return static::extracted($oPdoStatement);
    }


    public static function find(int $iId): ?Product
    {
        $oPdo = DbManager::getInstance();

        $sQuery = 'SELECT * 
            FROM ' . static::TABLE .
            ' WHERE product.id = :id';

        $oPdoStatement = $oPdo->prepare($sQuery);
        $oPdoStatement->bindValue('id', $iId, \PDO::PARAM_INT);
        $oPdoStatement->execute();

        $aDbProduct = $oPdoStatement->fetch();

        return $aDbProduct ? static::hydrate($aDbProduct) : NULL;
    }


    public static function findBy(array $aCriterias,int $iOffset = 0, int $iNbElts = self::NB_ELT_PER_PAGE): array
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

	  $sQuery .= ' ORDER BY `productCategory_id`,`name`';

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
     * @param array $aDbProduct
     * @return Product
     * @throws \Exception
     */
    protected static function hydrate(array $aDbProduct): Product
    {
        $oProduct = new Product(
            $aDbProduct['name'],
            $aDbProduct['description'],
            ProductCategoryRepository::find($aDbProduct['productCategory_id']),
	  	ProductFrequencyRepository::find($aDbProduct['frequency']));

        $oProduct->setIngredients($aDbProduct['ingredients']);
        $oProduct->setId($aDbProduct['id']);
        if(! empty($aDbProduct['picture']))
        {
            $oProduct->setPicture($aDbProduct['picture']);
        };
        $oProduct->setStatus($aDbProduct['status']);
        $oProduct->setCreatedAt(new \DateTime($aDbProduct['created_at']));

        return $oProduct;
    }


    public static function countBy(array $aCriterias): int|array
    {
        //Récupère une variable extérieure
        $oPdo = DbManager::getInstance();

        // Configuration de la requête
        $sQuery='SELECT COUNT(*) AS nbProducts FROM ' . static::TABLE;

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

        $nbProducts = (int) $result['nbProducts'];

        return $nbProducts;

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

        // 1. Si catégorie définie dans $aCriterias, ajouter une clause WHERE
        if(! empty($aCriterias['category']))
        {
            $aWhere[] =' (productCategory_id = :category)';
            $aParams[':category'] =  $aCriterias['category'];
        };

        // 2. Si "magic-search" est défini
        if(! empty($aCriterias['magic-search']))
        {
            $aWhere[] = ' ((`name` LIKE :magicsearch)
                        OR (`description` LIKE :magicsearch)
                        OR (`ingredients` LIKE :magicsearch))';
            $aParams[':magicsearch'] =  '%' . $aCriterias['magic-search'] . '%';
        };

        // 3. Si "status" est défini
        if(! empty($aCriterias['status']))
        {
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

}