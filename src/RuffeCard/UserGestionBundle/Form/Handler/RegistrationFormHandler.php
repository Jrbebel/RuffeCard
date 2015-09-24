<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RuffeCard\UserGestionBundle\Form\Handler;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class RegistrationFormHandler //extends
{
    protected $request;
    protected $userManager;
    protected $form;
    protected $mailer;
    protected $tokenGenerator;

    public function __construct(FormInterface $form, Request $request, UserManagerInterface $userManager, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator)
    {
    	$this->form = $form;
    	$this->request = $request;
    	$this->userManager = $userManager;
    	$this->mailer = $mailer;
    	$this->tokenGenerator = $tokenGenerator;
// parent::__construct($form, $request, $userManager, $mailer, $tokenGenerator);
    }


 /**
     * @param boolean $confirmation
     */
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        if ($confirmation) {
            $user->setEnabled(false);
            if (null === $user->getConfirmationToken()) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
            }

            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
        	
        	  $user->setRoles(array('ROLE_USER' => 'ROLE_USER'));
            $user->setEnabled(true);
        }

        $this->userManager->updateUser($user);
    }
    
    
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false,$type)
    {
    
        $user = $this->createUser();
		
        $this->form->setData($user);
	    
        /****************************/
 
        if($type == 1){
        	$user->setFonction(1);
        }elseif($type == 2){
        	$user->setFonction(2);
        }
		
	
        
     
      
        
        /******************************/
       
        
        if ('POST' === $this->request->getMethod()) {
        	
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
           
               $this->onSuccess($user, $confirmation);

                return true;
            }
        }

        return false;
    }

    /**
     * @return UserInterface
     */
    protected function createUser()
    {
    	return $this->userManager->createUser();
    }
    

}
