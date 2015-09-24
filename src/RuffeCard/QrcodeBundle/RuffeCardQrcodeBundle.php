<?php

namespace RuffeCard\QrcodeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RuffeCardQrcodeBundle extends Bundle
{
	public function getParent()
	{
		return 'MopaBarcodeBundle';
	}
	
}
