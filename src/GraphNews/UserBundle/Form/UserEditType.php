<?php

namespace GraphNews\UserBundle\Form;


use Symfony\Component\Form\FormBuilderInterface;


class UserEditType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('password')
            ->add('roles', 'choice', array(
                'choices' =>
                    array(
                        'ROLE_USER' => 'ROLE_USER',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                    ),
                'required' => true,
                'multiple' => true
            ));
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GraphNews\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'GraphNews_userbundle_usertype';
    }
}
