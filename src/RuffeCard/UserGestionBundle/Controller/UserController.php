<?php

namespace RuffeCard\UserGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RuffeCard\UserGestionBundle\Entity\User;
use RuffeCard\UserGestionBundle\Form\UserType;
use FOS\UserBundle\Util\UserManipulator;
use RuffeCard\UserGestionBundle\Form\Handler\RegistrationFormHandler;
use Symfony\Component\HttpFoundation\Response;
/**
 * User controller.
 *
 * @Route("/Admin/user")
 */
class UserController extends Controller {
	
	/**
	 * Lists all User entities.
	 *
	 * @Route("/{acteur}/index", name="Admin_user")
	 * @Method("GET")
	 * @Template()
	 */
	public function indexAction($acteur) {
		$em = $this->getDoctrine ()->getManager ();
		$paginator = $this->get ( 'knp_paginator' );
		$entities = $em->getRepository ( 'RuffeCardUserGestionBundle:User' )->findAllActeur ( $acteur );
		$pagination = $paginator->paginate ( $entities, $this->get ( 'request' )->query->get ( 'page', 1 )/* page number */, 3/* limit per page */
        );
		return array (
				'entities' => $entities,
				"pagination" => $pagination ,
				"Type"=>$acteur
		);
	}
	/**
	 * Creates a new User entity.
	 *
	 * @Route("/", name="Admin_create")
	 * @Method("POST")
	 * @Template("RuffeCardUserGestionBundle:User:new.html.twig")
	 */
	public function createAction(Request $request) {
		$entity = new User ();
		$form = $this->createCreateForm ( $entity );
		$form->handleRequest ( $request );
	
		if ($form->isValid ()) {

			$type = $this->getRequest ()->get ( 'Type' );
			$em = $this->getDoctrine ()->getManager ();
			
			if ($type == 1) {
				$entity->setFonction ( 1 );
			} elseif ($type == 2) {
				$entity->setFonction ( 2 );
			}
			
			$em->persist ( $entity );
			$em->flush ();
			
			return $this->redirect ( $this->generateUrl ( 'Admin_show', array (
					'id' => $entity->getId () 
			) ) );
		}
		
		return array (
				'entity' => $entity,
				'Type' => $type,
				'form' => $form->createView () 
		);
	}
	
	/**
	 * Creates a form to create a User entity.
	 *
	 * @param User $entity
	 *        	The entity
	 *        	
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createCreateForm(User $entity) {
		
		$form = $this->createForm ( new UserType (), $entity, array (
				'action' => $this->generateUrl ( 'Admin_create' ),
				'method' => 'POST' 
		) );
		
		$form->add ( 'submit', 'submit', array (
				'label' => 'Create' 
		) );
		
		return $form;
	}
	
	/**
	 * Displays a form to create a new User entity.
	 *
	 * @Route("/new/{type}", name="Admin_new")
	 *
	 * @Template()
	 *
	 * On crée le formulaire à partir d'un type
	 * 0 : Commerciaux
	 * 1 : Manager
	 * 2 : Administrateur
	 */
	public function newAction($type) {
	
		$type = $this->getRequest ()->get ( 'type' );
		
		print_r("le type est".$type );
		$em = $this->getDoctrine ()->getManager ();
	
		$userManager= $this->get ( 'fos_user.user_manager' );
		  
	
		$userMail = $this->get ( 'fos_user.mailer' );
		$formbuilder = $this->createForm ( new UserType ( $userManager->getClass () ) );
		$formhandler = new \RuffeCard\UserGestionBundle\Form\Handler\RegistrationFormHandler ( $formbuilder, $this->get ( 'request' ), $userManager, $userMail, $this->container->get ( 'fos_user.util.token_generator' ) );
		
		if ($formhandler->process ( null, $type)) {
			
			return $this->redirect ( $this->generateUrl ( 'Admin_user', array (
					'acteur' => $type 
			) ) );
		}
		
		return $this->render ( 'RuffeCardUserGestionBundle:Registration:register.html.twig', array (
				'form' => $formbuilder->createView (),
				'Type' => $type,
				'Method'=>"new"
		) );
	}
	
	/**
	 * Finds and displays a User entity.
	 *
	 * @Route("/{id}/{type}/show", name="Admin_show")
	 * @Method("GET")
	 * @Template()
	 * 
	 */
	public function showAction($id,$type) {
		$em = $this->getDoctrine ()->getManager ();
		
		$entity = $em->getRepository ( 'RuffeCardUserGestionBundle:User' )->find ( $id );
		// $entity = $em->getRepository('RuffeCardUserGestionBundle:User')->FindUserAction($type, $id);
		
		if (! $entity) {
			throw $this->createNotFoundException ( 'Unable to find User entity.' );
		}
		
		$deleteForm = $this->createDeleteForm ( $id );
		
		return array (
				'entity' => $entity,
				'delete_form' => $deleteForm->createView (),
				'Type'=>$type
		);
	}
	
	/**
	 * Displays a form to edit an existing User entity.
	 *
	 * @Route("/{id}/edit", name="Admin_edit")
	 *
	 * @Template()
	 */
	public function editAction($id) {
	
		$userManager = $this->get ( 'fos_user.user_manager' );
		$userMail = $this->get ( 'fos_user.mailer' );
		$type = $this->getRequest ()->get ( 'type' );
		
		$user = $userManager->findUserBy ( array (
				'id' => $id 
		) );
		$formbuilder = $this->createForm ( new UserType ( $userManager->getClass () ), $user );
		$formhandler = new \RuffeCard\UserGestionBundle\Form\Handler\RegistrationFormHandler ( $formbuilder, $this->get ( 'request' ), $userManager, $userMail, $this->container->get ( 'fos_user.util.token_generator' ) );
		
		if ($this->getRequest ()->getMethod () == 'POST') {
			
			$capture = $this->getRequest ()->get ( 'ruffecard_usergestionbundle_user' );
			
			$user->setUsername ( $capture ['username'] );
			$user->setNom ( $capture ['nom'] );
			$user->setPrenom ( $capture ['prenom'] );
			$user->setRoles ( $user->getRoles () );
			$user->setEmail ( $capture ['email'] );
			$user->setPlainPassword ( $capture ['plainPassword'] ['first'] );
			$user->setEmail ( $capture ['email'] );
			$user->setFacebook( $capture ['facebook'] );
			$user->setTwitter( $capture ['twitter'] );
			$user->setGoogleplus( $capture ['googleplus'] );
			
			
			
			$userManager->updateUser ( $user );
			
		return $this->redirect ( $this->generateUrl ( 'Admin', array (
 					'acteur' => $type 
 			) ) );
		}
		return $this->render ( 'RuffeCardUserGestionBundle:Registration:register.html.twig', array (
				'form' => $formbuilder->createView (),
				'Type' => $type,
				'Method'=>"edit" 
		) );
	}
	
	/**
	 * Creates a form to edit a User entity.
	 *
	 * @param User $entity
	 *        	The entity
	 *        	
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createEditForm(User $entity) {
		
		
		$form = $this->createForm ( new UserType (), $entity, array (
				'action' => $this->generateUrl ( 'Admin_update', array (
						'id' => $entity->getId () 
				) ),
				'method' => 'PUT' 
		) );
		
		$form->add ( 'submit', 'submit', array (
				'label' => 'Update' 
		) );
		
		return $form;
	}

	/**
	 * Deletes a User entity.
	 *
	 * @Route("/{id}",name="Admin_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, $id) {
	
		$form = $this->createDeleteForm ( $id );
		$form->handleRequest ( $request );
		
		if ($form->isValid ()) { 
			$em = $this->getDoctrine ()->getManager ();
			$entity = $em->getRepository ( 'RuffeCardUserGestionBundle:User' )->find ( $id );
			
			if (! $entity) {
				throw $this->createNotFoundException ( 'Unable to find User entity.' );
			}
			
			$em->remove ( $entity );
			$em->flush ();
		}

		return $this->redirect ( $this->generateUrl ( 'Admin_user',array('acteur'=>$entity->getFonction()) ) );
	}
	
	/**
	 * Creates a form to delete a User entity by id.
	 *
	 * @param mixed $id
	 *        	The entity id
	 *        	
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm($id) {
		return $this->createFormBuilder ()->setAction ( $this->generateUrl ( 'Admin_delete', array (
				'id' => $id 
		) ) )->setMethod ( 'DELETE' )
		//->add ( 'submit', 'submit', array (
			//	'label' => 'Delete' 
		//) 
		//)
		->getForm ();
	}
	
	/**
	 * Recherche un commercial dans la table user*
	 *
	 * @Route("/searchcommercial", name="Admin_search_commercial")
	 * 
	 */
	public function SearchCommercial(){
		
		$request = $this->get ( 'request' );
		if ($request->isXmlHttpRequest ()) {
			$term = $request->request->get ( 'motcle' );
			$fonction = $request->request->get ( 'fonction' );
			
				$array = $this->getDoctrine ()->getEntityManager ()->getRepository ( 'RuffeCardUserGestionBundle:User' )->FindCommercial($term);
			
		//$array=array("riviere"=>"riverer");
			$reponse = new Response ( json_encode ( $array ) );
			$reponse->headers->set ( 'content-Type', 'application/json' );
			return $reponse;
		}
	}
	
	
	
}
