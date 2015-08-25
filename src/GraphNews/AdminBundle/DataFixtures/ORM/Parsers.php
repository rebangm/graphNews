<?php


namespace GraphNews\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GraphNews\AdminBundle\Entity\Parser;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;


class Parsers implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Les noms d'utilisateurs à créer
        $parsers = array(
            'le monde' => array('{"id":{"path":"/id","function":""},"author":{"path":"/author","function":""},"text":{"path":"/text","function":""},"datePublished":{"path":"/date","function":""},"dateModified":{"path":"/date","function":""},"dateCreated":{"path":"/date","function":""},"url":{"path":"/date","function":""},"name":{"path":"/name","function":""}}'),
            'le figaro' => array('{"id":{"path":"/id","function":""},"author":{"path":"/author","function":""},"text":{"path":"/text","function":""},"datePublished":{"path":"/date","function":""},"dateModified":{"path":"/date","function":""},"dateCreated":{"path":"/date","function":""},"url":{"path":"/date","function":""},"name":{"path":"/name","function":""}}')
        );

        foreach ( $parsers as $i => $parser )
        {
            // On crée l'utilisateur
            $sites[$i] = new Parser();
            $sites[$i]->setName($i);
            $sites[$i]->setFormat($parser[0]);
            $manager->persist($sites[$i]);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }

}