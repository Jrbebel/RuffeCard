<?php

namespace RuffeCard\UserGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UserType extends  BaseType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);
        $builder
           
            ->add('nom')
            ->add('prenom')
            ->add('dayBirth')
            ->add('sexe','choice', array('choices' => array('m' => 'Masculin', 'f' => 'Féminin'),'multiple' => false, 'expanded' => true,'required' => true))
            ->add('age')
            ->add('telFixe')
            ->add('portable1')
            ->add('portable2')
            ->add('portable3')
            ->add('facebook')
            ->add('twitter')
            ->add('googleplus')
            ->add('adresse', 'collection', array('type' => new AdresseType(),
            		'allow_add'    => true,
            		'allow_delete' => true))
               ->add('Commercial', 'entity', array("label"=>' ','class' => 'RuffeCardUserGestionBundle:User', 'property' => 'nom', 'attr' => array('class' => 'form-control')))
        ;
    }


    public function getDefaultOptions(array $options) {
    	parent::getDefaultOptions($options);
    
    	return array(
    			'data_class' => 'RuffeCard\UserGestionBundle\Entity\User',
    	);
    }
    
    
//     /**
//      * @param OptionsResolverInterface $resolver
//      */
//     public function setDefaultOptions(OptionsResolverInterface $resolver)
//     {
//         $resolver->setDefaults(array(
//             'data_class' => 'RuffeCard\UserGestionBundle\Entity\User'
//         ));
//     }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruffecard_usergestionbundle_user';
    }
}
