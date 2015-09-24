<?php

namespace RuffeCard\UserGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commune')
            ->add('codepostale','text',array("label"=>'Code postale'))
            ->add('rue')
            ->add('boitepostale','text',array("label"=>'Boite postale'))
            ->add('quartier')
            ->add('ville')
            ->add('departementregion','text',array("label"=>'Département/Région'))
            ->add('paysregion','text',array("label"=>'Pays/Région'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RuffeCard\UserGestionBundle\Entity\Adresse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruffecard_usergestionbundle_adresse';
    }
}
