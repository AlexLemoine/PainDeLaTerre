<?php

// Besoin de ces lignes comme dans index

// Chargement de l'autoload de Composer
// va charger la librairie composer:
require 'vendor/autoload.php';

//On indique à PHP que l'on veut utiliser le concept des sessions
session_start();

require_once 'lib/config.php';

// Appeler le controller
if(isset($_POST['context'])){
	switch ($_POST['context'])
	{
		case PAGE_ADMIN_PRODUCTS:
			echo (new Pdlt\Controller\AdminProductsController)->refreshProducts();
			break;
			
//		case PAGE_ADMIN_COMPANY:
//			echo (new Pdlt\Controller\AdminCompanyController)->refreshCompany();
//			break;
	
	}
}

