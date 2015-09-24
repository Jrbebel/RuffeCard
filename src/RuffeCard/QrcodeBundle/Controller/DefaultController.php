<?php

namespace RuffeCard\QrcodeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Mopa\Bundle\BarcodeBundle\Controller\BarcodeController as Barcodecontroller;

class DefaultController extends barcodecontroller
{
    /**
     * @Route("/qrcodes")
     * @Template()
     */
    public function indexAction()
    {
    	$type=2;
    	$encty="Le texte";
    	$reponse=parent::displayBarcodeAction($type,$encty);
        return $reponse;
        //return $this->render("RuffeCardQrcodeBundle:Default:index.html.twig");
    }
}
