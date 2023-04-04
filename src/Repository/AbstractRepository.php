<?php

namespace Pdlt\Repository;


abstract class AbstractRepository
{
    // Méthode abstraite = permet d'imposer une fonction aux "enfants"
    // sans écrire de code pour les laisser gérer les paramètres nécessaires
    // Ca force les enfants à le faire

    const NB_ELT_PER_PAGE = 10;

    abstract public static function findAll(): array;

    abstract public static function find(int $iId): ?object;


    abstract public static function findBy(array $aCriterias,int $iOffset = 0, int $iNbElts = self::NB_ELT_PER_PAGE): array;

    abstract protected static function hydrate(array $aDbInfo): object;

    abstract protected static function countBy(array $aCriterias): int|array;

    /**
     * @param \PDOStatement $oPdoStatement
     * @return array
     */
    protected static function extracted(\PDOStatement $oPdoStatement): array
    {
        $aList = [];

        while ($aDbCategories = $oPdoStatement->fetch())
        {
            $aList[] = static::hydrate($aDbCategories);
        };

        return $aList;
    }

}