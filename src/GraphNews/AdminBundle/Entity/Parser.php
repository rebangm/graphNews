<?php

namespace GraphNews\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GraphNews\AdminBundle\Entity\ParserRepository")
 */
class Parser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="format", type="json_array")
     */
    private $format;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Parser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set format
     *
     * @param array $format
     * @return Parser
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return array 
     */
    public function getFormat()
    {
        return $this->format;
    }
}
