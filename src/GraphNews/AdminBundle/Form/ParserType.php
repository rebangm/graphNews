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
            ->add('format', 'ace_editor', array(
                'wrapper_attr' => array(), // aceeditor wrapper html attributes.
                'width' => 600,
                'height' => 200,
                'font_size' => 12,
                'theme' => 'ace/theme/monokai'// every single default theme must have ace/theme/* prefix
            ))

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
