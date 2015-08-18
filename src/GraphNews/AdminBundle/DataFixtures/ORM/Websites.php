<?php


namespace GraphNews\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use GraphNews\AdminBundle\Entity\Website;

class Websites implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Les noms d'utilisateurs à créer
        $websites = array(
            'le monde' => array('http://lemonde.fr',true,"* * * * *"),
            'le figaro' => array('http://lefigaro.fr',true,"*/5 * * * *")
        );

        foreach ( $websites as $i => $website )
        {
            // On crée l'utilisateur
            $sites[$i] = new Website();
            $sites[$i]->setName($i);
            $sites[$i]->setUrl($website[0]);
            $sites[$i]->setEnable($website[1]);
            $sites[$i]->setFrequency($website[2]);
            $manager->persist($sites[$i]);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }

}