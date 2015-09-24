<?php

namespace RuffeCard\UserGestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use RuffeCard\UserGestionBundle\Entity\User;

class DefaultController extends Controller {
	/**
	 * @Route("/",name="AcceuilAdmin")
	 * @Template("RuffeCardUserGestionBundle:Administrateur:IndexAdmin.html.twig")
	 */
	public function indexAction() {
			$user = $this -> container -> get('security.context') -> getToken() -> getUser();
		$Countotal = $this -> CountActeur();
		return array('Count' => $Countotal,'user'=>$user);
	}

	/**
	 * @Route("/redirection/agent")
	 *
	 * function description
	 * Redirection de l'agent selon sa fonction
	 */
	public function RedirectionagentAction() {

		$user = $this -> container -> get('security.context') -> getToken() -> getUser();
		// on récupere la fonction de l'utilisateur connecté

		if ($this -> get('security.context') -> isGranted('ROLE_SUPER_ADMIN')) {

			return $this -> redirect($this -> generateUrl('Admin_client', array('user' => $user)));

			// return $this->render ( "Inra2013urzBundle:Default:IndexAdmin.html.twig" );
		} elseif ($this -> get('security.context') -> isGranted('ROLE_ADMIN')) {// Pour l'administration

			return $this -> redirect($this -> generateUrl('AcceuilAdmin', array('user' => $user)));
			// 			return $this->render ( "RuffeCardUserGestionBundle:Administrateur:IndexAdmin.html.twig", array (
			// 					'Count' => $Countotal
			// 			) );
		} elseif ($this -> get('security.context') -> isGranted('ROLE_USER')) {

			return $this -> render("RuffeCardUserGestionBundle:Commercial:IndexCommercial.html.twig");
		}
	}

	/**
	 * Recherche un client dans la partie administateur*
	 *
	 * @Route("/admin/searchclient/{type}/{acteur}", name="Admin_search_client")
	 * si type est égale a 1,on modifie sinon on supprime
	 * Acteur // 0:Client,1:Entreprise,2:Commerciaux
	 */
	public function searchClientAction($type, $acteur) {
		$request = $this -> get('request');
		if ($request -> isXmlHttpRequest()) {
			$term = $request -> request -> get('motcle');
			$fonction = $request -> request -> get('fonction');
			if ($acteur == 0) {
				$array = $this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:Client') -> FindClient($term);
			} elseif ($acteur == 1) {
				$array = $this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:Entreprise') -> FindEntreprise($term);
			} elseif ($acteur == 2 || $acteur == 3) {
				$array = $this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:User') -> FindUser($term, $acteur);
			}

			$reponse = new Response(json_encode($array));
			$reponse -> headers -> set('content-Type', 'application/json');
			return $reponse;
		} elseif ($request -> getMethod() == 'POST') {

			$id = $this -> getRequest() -> get('institut');
			if ($type == 1 && $acteur == 0) {
				return $this -> redirect($this -> generateUrl('Admin_client_edit', array('id' => $id)));
			} elseif ($type == 0 && $acteur == 0) {
				return $this -> redirect($this -> generateUrl('Admin_client_show', array('id' => $id, 'type' => $type)));
			} elseif ($type == 1 && $acteur == 1) {
				return $this -> redirect($this -> generateUrl('Admin_entreprise_edit', array('id' => $id)));
			} elseif ($type == 0 && $acteur == 1) {
				return $this -> redirect($this -> generateUrl('Admin_entreprise_show', array('id' => $id, 'type' => $type)));
			} elseif ($type == 1 && $acteur == 2) {
				return $this -> redirect($this -> generateUrl('Admin_edit', array('id' => $id, 'type' => $type)));
			} elseif ($type == 1 && $acteur == 2) {
				return $this -> redirect($this -> generateUrl('Admin_show', array('id' => $id, 'type' => $type)));
			} elseif ($type == 2 && $acteur == 3) {
				return $this -> redirect($this -> generateUrl('Admin_edit', array('id' => $id, 'type' => $type)));
			} elseif ($type == 2 && $acteur == 3) {
				return $this -> redirect($this -> generateUrl('Admin_show', array('id' => $id, 'type' => $type)));
			}
		} else {
			return $this -> render("RuffeCardUserGestionBundle:Administrateur:RechercherClient.html.twig", array('type' => $type, 'acteur' => $acteur));
		}
	}

	/*
	 * Permet de compter les nombres d'acteur de l'application Présent sur la page d'index de la partie admin **
	 */
	public function CountActeur() {
		$TotalCountActeur = array();
		// Contient le total de tous les acteurs de l'application
		$TotalCountActeur['Client'] = count($this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:Client') -> findAll());
		$TotalCountActeur['Manager'] = count($this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:User') -> FindAllActeur("Manager"));
		$TotalCountActeur['Commercial'] = count($this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:User') -> FindAllActeur("Commercial"));
		$TotalCountActeur['Entreprise'] = count($this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:Entreprise') -> FindAll());

		return $TotalCountActeur;
	}

	/**
	 * Permet de changer le status d'un acteur
	 * 0:client
	 * 1:manager
	 * 2:commercial
	 *
	 * @Route("/admin/Change/{id}/{type}",name="ChangeStatus")
	 */
	public function ChangeStatusAction() {
		$id = $this -> getRequest() -> get('id');
		$type = $this -> getRequest() -> get('type');

		/**
		 * C'est un client*
		 */
		$em = $this -> getDoctrine() -> getManager();

		if ($type == 0) {

			$Client = $this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:Client') -> Find($id);

			if (!$Client) {
				throw $this -> createNotFoundException('Pas de client trouvé avec id ' . $id);
			} else {

				$manager = new User();
				$manager -> setUsername($Client -> getPrenom());
				$manager -> setEmail($Client -> getEmail());
				$manager -> setPassword("null");
				$manager -> setFacebook("null");
				$manager -> setTwitter("null");
				$manager -> setGoogleplus("null");
				$manager -> setNom($Client -> getNom());
				$manager -> setPrenom($Client -> getPrenom());
				$manager -> setDayBirth($Client -> getDayBirth());
				$manager -> setSexe($Client -> getSexe());
				$manager -> setage($Client -> getage());
				$manager -> settelFixe($Client -> gettelFixe());
				$manager -> setportable1($Client -> getportable1());
				$manager -> setportable2($Client -> getportable2());
				$manager -> setportable3($Client -> getportable3());
				$manager -> setFonction(1);

				$em -> persist($manager);
				$em -> flush();
				return $this -> redirect($this -> generateUrl('Admin_client'));
			}
		} elseif ($type == 1) {

			$User = $this -> getDoctrine() -> getEntityManager() -> getRepository('RuffeCardUserGestionBundle:User') -> Find($id);
			$User -> setFonction(2);
			$em -> persist($User);
			$em -> flush();
			return $this -> redirect($this -> generateUrl('Admin', array('acteur' => 2)));
		}
	}

	/**
	 * Permet de gerer les accueil de bouton navBar
	 *
	 * @Route("/gestion",name="Gestion_Accueil")
	 */
	public function AccueilNavBar() {

		$Countotal = $this -> CountActeur();

		return $this -> render("RuffeCardUserGestionBundle:Administrateur:GestionAccueil.html.twig", array('Count' => $Countotal));

	}

	// 	/**
	// 	 * Permet de gerer les accueil de bouton navBar
	// 	 *
	// 	 * @Route("/administration",name="Administration_Accueil")
	// 	 */
	// 	public function AccueilNavBar2() {

	// 		$Countotal = $this->CountActeur ();

	// 		return $this->render ( "RuffeCardUserGestionBundle:Administrateur:AdministrationAccueil.html.twig",array ('Count'=>$Countotal));

	// 	}
}
