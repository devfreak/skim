<?php

namespace Acme\StartUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * OptinData
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields={"email"},
 *               message="This email address has already been registered")
 */
class OptinData
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
     * @ORM\Column(name="email", type="string", length=200, unique=true)
     * @Assert\Email(message = "Invalid email address")
     * @Assert\NotBlank(message = "Invalid email address")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="`key`", type="string", length=100)
     */
    private $key;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean")
     */
    private $activated;


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
     * Set email
     *
     * @param string $email
     * @return OptinData
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return OptinData
     */
    public function setKey($key)
    {
        $this->key = $key;
    
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return OptinData
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    
        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean 
     */
    public function getActivated()
    {
        return $this->activated;
    }
}
