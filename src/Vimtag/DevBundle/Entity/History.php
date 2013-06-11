<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vimtag\DevBundle\Entity\HistoryRepository")
 */
class History
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
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\User", inversedBy="history")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\Url", inversedBy="history")
     * @ORM\JoinColumn(name="url_id", referencedColumnName="id")
     */
    private $url;

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
     * Set user
     *
     * @param \Vimtag\DevBundle\Entity\User $user
     * @return History
     */
    public function setUser(\Vimtag\DevBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Vimtag\DevBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set url
     *
     * @param \Vimtag\DevBundle\Entity\Url $url
     * @return History
     */
    public function setUrl(\Vimtag\DevBundle\Entity\Url $url = null)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return \Vimtag\DevBundle\Entity\Url 
     */
    public function getUrl()
    {
        return $this->url;
    }
}