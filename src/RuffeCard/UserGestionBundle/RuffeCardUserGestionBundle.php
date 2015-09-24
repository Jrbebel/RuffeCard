<?php

namespace RuffeCard\UserGestionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RuffeCardUserGestionBundle extends Bundle
{
	
	public function getParent()
	{
		return 'FOSUserBundle';
	}
	
}
