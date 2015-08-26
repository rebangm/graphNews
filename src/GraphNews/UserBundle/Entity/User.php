<?php

namespace GraphNews\UserBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GraphNews\UserBundle\Entity\UserRepository")
 * @UniqueEntity(fields="userName", message="Login déjà utilisé")
 */
class User implements AdvancedUserInterface
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
     * @ORM\Column(name="first_name", type="string", length=60)
     * @Assert\Length(
     *      min = "1",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=60)
     * @Assert\Length(
     *      min = "1",
     *      max = "50",
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas être plus long que {{ limit }} caractères")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=50, unique=true)
     * @Assert\Length(
     *      min = "5",
     *      max = "50",
     *      minMessage = "Votre login doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre login ne peut pas être plus long que {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $userName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=40)
     * @Assert\NotBlank()
     */
    private $salt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=80)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=16, nullable=true)
     */
    private $phoneNumber;
    
    /**
     * @var Array
     *
     * @ORM\Column(name="role", type="array")
     */
    private $roles = array();
    
    /**
     * @var string
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = True;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=120)
     * @Assert\Email(message="Adresse mail invalide")
     */
    private $mail;
    
    
    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }
    
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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
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


    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    public function eraseCredentials()
    {
        return $this->isActive;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUserName($username)
    {
        $this->userName = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set roles
     *
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    
        return $this;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }
}
