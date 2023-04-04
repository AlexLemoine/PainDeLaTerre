<?php

namespace Blog\Controller;

class DefaultController extends AbstractController
{

    /**
     *
     */
    public function home(): string
    {
        return $this->render('home.php',
            [
                'seo_title'=>TITLE_HOME,
            ]);
    }


//    /**
//     * Est-ce que le formulaire Contact a été soumis ?
//     */
//    public function contact(): string
//    {
//        if(isset($_POST['field_submitted'])) {
//
//            // Récupérer les données du formulaire (méthode POST)
//            // strip_tags sert à protéger les saisies utilisateurs
//            // pour éviter qu'un script saisi soit interprété
//            // enlève toutes les balises html + php
//            // on peut toutefois gérer des permissions (exemple balise br pour mettre en gras)
//            $sSubject = strip_tags($_POST['field_subject']);
//            $sContent = strip_tags($_POST['field_content']);
//            // $sMail = strip_tags($_POST['field_email']);
//
//            // filter_input() est plus puissant
//            // il permet de nettoyer les données entrantes
//            // en fonction du type de données attendu (email, string, url,...)
//            $sMail = filter_input(
//                INPUT_POST,
//                'field_email',
//                FILTER_SANITIZE_EMAIL
//            );
//
//            // Appeler la fonction sendMail($sMail, $sSubject, $sContent)
//            sendMail($sMail, $sSubject, $sContent);
//
//            // Renvoyer l'user sur page d'accueil une fois connecté
//            // Vide les données "post" et évite les doublons d'enregistrements
//            $this->redirectAndDie('index.php?page=home');
//        }
//        return $this->render('contact.php',[
//        'seo_title'=>TITLE_CONTACT]);
//    }



}