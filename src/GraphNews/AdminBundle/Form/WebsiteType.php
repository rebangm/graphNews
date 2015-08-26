<?php

namespace GraphNews\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebsiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('isActive')
            ->add('frequency')
            ->add('siteTemplate')
            ->add('lifetime','integer',array(
                'attr' => array('class' => 'aSpinEdit'))
            )
            ->add('Enregistrer' , 'submit', array(
                'attr' => array('class' => 'btn btn-primary'))
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GraphNews\AdminBundle\Entity\Website'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphnews_adminbundle_website';
    }
}
