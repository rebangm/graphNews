<?php

namespace GraphNews\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Website
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GraphNews\AdminBundle\Entity\WebsiteRepository")
 */
class Website
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
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=2048)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="frequency", type="string", length=50)
     */
    private $frequency;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="GraphNews\AdminBundle\Entity\Parser")
     * @ORM\JoinColumn(nullable=true)
     */

    private $siteTemplate;

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
     * @return Website
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
     * Set url
     *
     * @param string $url
     * @return Website
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Website
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set frequency
     *
     * @param string $frequency
     * @return Website
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return string 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set siteTemplate
     *
     * @param \GraphNews\AdminBundle\Entity\Parser $siteTemplate
     * @return Website
     */
    public function setSiteTemplate(\GraphNews\AdminBundle\Entity\Parser $siteTemplate)
    {
        $this->siteTemplate = $siteTemplate;

        return $this;
    }

    /**
     * Get siteTemplate
     *
     * @return \GraphNews\AdminBundle\Entity\Parser 
     */
    public function getSiteTemplate()
    {
        return $this->siteTemplate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Website
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
