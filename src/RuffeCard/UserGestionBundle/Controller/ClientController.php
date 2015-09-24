<?php

namespace RuffeCard\UserGestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RuffeCard\UserGestionBundle\Entity\Client;
use RuffeCard\UserGestionBundle\Form\ClientType;
use Symfony\Component\HttpFoundation\Response;
use RuffeCard\UserGestionBundle\Controller\DefaultController;

/**
 * Client controller.
 *
 * @Route("/Admin/client")
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     * @Route("/", name="Admin_client")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RuffeCardUserGestionBundle:Client')->findClientPaiment();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Client entity.
     *
     * @Route("/", name="Admin_client_create")
     * @Method("POST")
     * @Template("RuffeCardUserGestionBundle:Client:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Client();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_client_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Client entity.
    *
    * @param Client $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('Admin_client_create'),
            'method' => 'POST',
        ));

      //  $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Client entity.
     *
     * @Route("/new", name="Admin_client_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Client();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Client entity.
     *
     * @Route("/{id}", name="Admin_client_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RuffeCardUserGestionBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }
        $Status=$this->VerifStatus($entity->getEmail());
        $deleteForm = $this->createDeleteForm($id);
     
     
 
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createview(),
        	'Status' => $Status,	
        		
        );
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="Admin_client_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RuffeCardUserGestionBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Client entity.
    *
    * @param Client $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('Admin_client_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Client entity.
     *
     * @Route("/{id}", name="Admin_client_update")
     * @Method("PUT")
     * @Template("RuffeCardUserGestionBundle:Client:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
    	
    	$request = $this->getRequest();
    	
    	if($request->getMethod() == "GET"){
    		return new Response('methode get ');
    	}
    	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RuffeCardUserGestionBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

//             return $this->redirect($this->generateUrl('Admin_client_edit', array('id' => $id)));
// Redirection vers le profil fraichement crée
            return $this->redirect($this->generateUrl('Admin_client_show', array('id' => $entity->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Client entity.
     *
     * @Route("/{id}", name="Admin_client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RuffeCardUserGestionBundle:Client')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Client entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Admin_client'));
    }

    /**
     * Creates a form to delete a Client entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_client_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    

    public function VerifStatus($Email) {
    	$em = $this->getDoctrine ()->getEntityManager ();
    	
    			
    		$Client = $em->getRepository ( 'RuffeCardUserGestionBundle:User' )->FindOneBy(array("email"=>$Email));
    		
    		if ($Client == null) {
    			return 1;
    		} else {
    			return 0;
    		}
    	
    }   
    
    
    
}
