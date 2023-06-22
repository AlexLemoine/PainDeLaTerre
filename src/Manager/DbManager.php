<?php
namespace Pdlt\Manager;

// Va servir à faire le lien et gérer la BDD
// Avoir un accès rapide à notre BDD
// + propre que de faire un "global $oPdo"

class DbManager {

    // ATTRIBUTS

    /**
     * @var \PDO|null  // soit PDO, soit NULL
     *
     */
    private static ?\PDO $instance = NULL;


    // FONCTIONS
	
	/**
	 * Créer une connexion à ma BDD
	 * @return \PDO
	 */
    public static function getInstance(): \PDO
    {
        // Pour ne le faire qu'une seule fois :
        if(!static::$instance instanceof \PDO){
            // PDO - Relier SQL avec PHP
            // DataSourceName - ligne qui contient des infos combinées
            $sDSN = 'mysql:dbname='. DB_NAME . ';host='. DB_HOST.';charset=UTF8';

            $aOptions = [
                // Pour mysql, forcer le passage en UTF8 (encryptage)
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
            ];

            $oPdo = new \PDO($sDSN,DB_USER,DB_PASSWORD,$aOptions);

            // On personnalise l'affichage des erreurs (en development)
            if (ENV === 'development') {
                $oPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            }
            static::$instance = $oPdo;
        }

        return static::$instance;
    }


}