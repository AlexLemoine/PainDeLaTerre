<?php

namespace Pdlt\Controller;

use Pdlt\Repository\{ProductRepository, ProductCategoryRepository};

class ProductController extends AbstractController
{
    public function product(): string
    {
        return $this->render(
            'products.php',
            [
                'seo_title' => 'Les Produits',
                'categories' => ProductCategoryRepository::findAll(),
            ]
        );
    }

    public function refreshProducts(): string
    {
        // Debug : On force un délai d'attente pour laisser le loader s'afficher
//        sleep(1);

        // (3) Récupération (+ nettoyage des données POST ou GET)
        $aCriterias = [];

        if(array_key_exists('category',$_GET))
        {
            $aCriterias['category'] = strip_tags($_GET['category']);
        };

        // Stockage en session des critères pour la pagination
        $_SESSION['criterias'] = $aCriterias;

        // 1. Calculer l'offset
        $iPage = ($_GET['listing_page'] ?? 1);
        $iNbEltsPerPage = ProductRepository::NB_ELT_PER_PAGE;
        $iOffset = ($iPage - 1) * $iNbEltsPerPage;

        $aParams =  [
            'products' => ProductRepository::findBy($aCriterias, $iOffset, $iNbEltsPerPage),
            'currentPage' => $iPage,
            'nb_results' => ProductRepository::countBy($aCriterias),
            'nb_results_per_page' => $iNbEltsPerPage,
        ];

        // 2. Récupérer les utilisateurs et renvoyer la vue HTML
        return $this->render('_products.php', $aParams, true);
    }

}