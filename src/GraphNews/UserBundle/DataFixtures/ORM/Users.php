<?php


namespace GraphNews\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use GraphNews\UserBundle\Entity\User;

class Users implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Les noms d'utilisateurs à créer
        $noms = array( 
            'jpdepigny' => array('Jean-Philippe','Dépigny'), 
            'esage' => array('Elodie','Sage'),
            'edepigny' => array('Elise','Dépigny'),
            'ngrevet' => array('Nicolas','Grevet'),
            'gdievart' => array('Guillaume','Diévart'),
            'mvial' => array('Michaël','Vial'),
            'jpetit' => array('Jérémy','Petit'),
            'rdagod' => array('Romain','Dagod'),
            'ctofan' => array('Cristina','Tofan'),
            'jdepigny' => array('Jean-Paul','Dépigny'),
            'mhdepigny' => array('Marie-Hélène','Dépigny'));

        foreach ( $noms as $i => $nom )
        {
            // On crée l'utilisateur
            $users[$i] = new User;
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($users[$i]);
           
            $users[$i]->setPassword($encoder->encodePassword($i, $users[$i]->getSalt()));
            
            // Le nom d'utilisateur et le mot de passe sont identiques
            $users[$i]->setUsername($i);
            
            $users[$i]->setFirstName($nom[0]);
            $users[$i]->setLastName($nom[1]);
            $users[$i]->setMail($i.'@posphp.com');
            //$users[$i]->set($nom);
            // Le sel et les rôles sont vides pour l'instant
            $users[$i]->setRoles(array( 'ROLE_USER' ));
            
            if($i == 'jpdepigny')
                $users[$i]->setRoles(array( 'ROLE_ADMIN' ));
            if($i == 'edepigny')
                $users[$i]->setIsActive ( False);
            // On le persiste
            //var_dump($users[$i]);
            $manager->persist($users[$i]);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }

}