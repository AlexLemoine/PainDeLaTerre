<?php

namespace Pdlt\Controller;

use Pdlt\Repository\PresentationRepository;

class PresentationController extends AbstractController
{
	
	public function boulangerie(): string
	{
		
		return $this->render(
		    'boulangerie.php',
		    [
			  'seo_title' => 'Notre boulangerie',
			  'presentation' => PresentationRepository::findAll(),
		    ]
		);
	}
	
	
}