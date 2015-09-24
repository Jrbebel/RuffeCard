<?php

namespace RuffeCard\UserGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('email')
            ->add('metier')
            ->add('passions')
            ->add('loisir')
            ->add('adresse', 'collection', array('type'         => new AdresseType(),
            		'allow_add'    => true,
            		'allow_delete' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RuffeCard\UserGestionBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruffecard_usergestionbundle_client';
    }
}
