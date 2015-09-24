<?php

namespace RuffeCard\TresorieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RuffeCard\TresorieBundle\Entity\Paiement;
use Symfony\Component\HttpFoundation\Response;
use RuffeCard\UserGestionBundle\Controller\UserController;


/**
 * default controller.
 *
 * @Route("/Administation")
 */


class DefaultController extends Controller
{
    /**
     * @Route("/index",name="indexAdministrateur")
     * @Template("RuffeCardTresorieBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$test= new UserController();
		$id=1;
		$type=2;
		
		
    	$entityClient = $em->getRepository('RuffeCardUserGestionBundle:Client')->findClientNoPaiment();
    	$entityManager=$em->getRepository('RuffeCardUserGestionBundle:User')->findClientNoPaiment(2);
    	$entityCommercial=$em->getRepository('RuffeCardUserGestionBundle:User')->findClientNoPaiment(1);
    	$entityEntreprise= $em->getRepository('RuffeCardUserGestionBundle:Entreprise')->findClientNoPaiment();
        
        $Countotal = $this->CountActeur ();
        
         
        return array(
        	
        		'Client'=>$entityClient,
        		'Entreprise'=>$entityEntreprise,
        		'Commercial'=>$entityCommercial,
        		'Manager'=>$entityManager,
        		'Count'=>$Countotal
        		
        );
    }
    /**
     * @Route("{id}/{acteur}/paiement",name="Reglerpaiement")
     *
     */
    public function ReglerPaiementAction($id,$acteur){

    	
    	$em = $this->getDoctrine()->getManager();
    	$paiement = new paiement();
    	$paiement->setdate(new \DateTime() );
    	$paiement->setpaye(true);
    	
    
    	
    	if($acteur == 0){
    		$entity = $em->getRepository('RuffeCardUserGestionBundle:Client')->find($id);
    		
    	}elseif($acteur == 1 || $acteur == 2 ){
    		$entity = $em->getRepository('RuffeCardUserGestionBundle:User')->find($id);
    	}elseif($acteur == 3 ){
    		$entity = $em->getRepository('RuffeCardUserGestionBundle:Entreprise')->find($id);
    	}
    	$entity->setPaiement($paiement);
    	$em->persist($entity);
    	$em->flush();
    	
   return $this->redirect($this->generateUrl('indexAdministrateur'));
    }
    
    /*
     * Permet de compter les nombres d'acteur de l'application Présent sur la page d'index de la partie admin **
     */
    public function CountActeur() {
        $TotalCountActeur = array (); // Contient le total de tous les acteurs de l'application
        $TotalCountActeur ['Client'] = count ( $this->getDoctrine ()->getEntityManager ()->getRepository('RuffeCardUserGestionBundle:User')->findClientNoPaiment(2));
        $TotalCountActeur ['Manager'] = count ( $this->getDoctrine ()->getEntityManager ()->getRepository ( 'RuffeCardUserGestionBundle:User' )->findClientNoPaiment(2) );
        $TotalCountActeur ['Commercial'] = count ( $this->getDoctrine ()->getEntityManager ()->getRepository ( 'RuffeCardUserGestionBundle:User' )->findClientNoPaiment(1) );
        $TotalCountActeur ['Entreprise'] = count ( $this->getDoctrine ()->getEntityManager ()->getRepository ( 'RuffeCardUserGestionBundle:Entreprise' )->findClientNoPaiment() );
        
        return $TotalCountActeur;
    }
    
        
    
    /**
     * Permet de voir les client en attente de paiement
     *
     * @Route("/administration_client_attente",name="Administration_Client_Paiement")
     */
    public function TresorieClient() {
        
        $em = $this->getDoctrine()->getManager();
        $entityClient = $em->getRepository('RuffeCardUserGestionBundle:Client')->findClientNoPaiment();
        return $this->render ( "RuffeCardTresorieBundle:Default:clientPaiement.html.twig", array ('Client'=>$entityClient));
    
    }
    
     /**
     * Permet de voir les client en attente de paiement
     *
     * @Route("/administration_manager_attente",name="Administration_Manager_Paiement")
     */
    public function TresorieManager() {
        
        $em = $this->getDoctrine()->getManager();
        $entityManager=$em->getRepository('RuffeCardUserGestionBundle:User')->findClientNoPaiment(2);
        return $this->render ( "RuffeCardTresorieBundle:Default:managerPaiement.html.twig", array ('Manager'=>$entityManager));
    
    }
    
     /**
     * Permet de voir les client en attente de paiement
     *
     * @Route("/administration_entreprise_attente",name="Administration_Entreprise_Paiement")
     */
    public function TresorieEntreprise() {
        
        $em = $this->getDoctrine()->getManager();
        $entityEntreprise= $em->getRepository('RuffeCardUserGestionBundle:Entreprise')->findClientNoPaiment();
        return $this->render ( "RuffeCardTresorieBundle:Default:entreprisePaiement.html.twig", array ('Entreprise'=>$entityEntreprise));
    
    }
    
     /**
     * Permet de voir les client en attente de paiement
     *
     * @Route("/administration_commerciaux_attente",name="Administration_Commerciaux_Paiement")
     */
    public function TresorieCommerciaux() {
        
        $em = $this->getDoctrine()->getManager();
        $entityCommercial=$em->getRepository('RuffeCardUserGestionBundle:User')->findClientNoPaiment(1);
        return $this->render ( "RuffeCardTresorieBundle:Default:commerciauxPaiement.html.twig", array ('Commercial'=>$entityCommercial));
    
    }
}
