<?php

namespace RuffeCard\UserGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntrepriseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('societe')
            ->add('numsiret')
            ->add('taille','choice', array('choices' => array('1-10' => '1-10', '11-50' => '11-50'),'multiple' => false, 'expanded' => true,'required' => true))
            ->add('contactResp')
            ->add('emailResp')
            ->add('telResp')
            ->add('site')
            ->add('facebook')
            ->add('autre')
            ->add('secteuractivite')
            ->add('pourcentage')
            ->add('association','choice', array('choices' => array('1' =>'Oui' , '0' => 'Non'),'multiple' => false, 'expanded' => true,'required' => true))
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
            'data_class' => 'RuffeCard\UserGestionBundle\Entity\Entreprise'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruffecard_usergestionbundle_entreprise';
    }
}
