<?php
namespace Pdlt\Controller;

class AbstractController
{

    protected function redirectAndDie(string $sUrl)
    {
        header('Location: ' . $sUrl);
        die;
    }


    /**
     * Génère la vue ddée avec les paramètres donnés
     * @param string $sView
     * @param array $aParams
     * @return string
     */
    public function render(string $sView, array $aParams = [], $bAjax = false): string
    {
        // On génère les variables correspondantes ($h1, $title, $sView)
        extract($aParams);

        // ob_start() permet de démarrer un buffer tampon dans la mémoire de php
        // tous les affichages (echo, include) sont mis en mémoire
        ob_start();

        // template.php sert à la structure principale du html (sans le <main>)
        $sTemplate = __DIR__.'/../../views/base.php';
        // si je suis en Ajax, je ne charge que la vue partielle (un morceau de code)
        // et non pas "base.php"
        if($bAjax)
        {
           $sTemplate =  __DIR__.'/../../views/'. $sView;
        };
        include $sTemplate;

        // ob_get_clean() retourne tout le contenu du buffer
        // nettoie et ferme le buffer
        // et on le stocke dans une variable
        return ob_get_clean();
    }


}