<?php

namespace GraphNews\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('format', 'textarea',  array(
                'attr' => array('class' => 'editor'))
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
            'data_class' => 'GraphNews\AdminBundle\Entity\Parser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphnews_adminbundle_parser';
    }
}
