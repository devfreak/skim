<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\HistoryRepository")
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
     * @var integer
     *
     * @ORM\Column(name="interested", type="integer")
     */
    private $interested;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\User", inversedBy="history")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\Url", inversedBy="history", cascade={"persist"})
     * @ORM\JoinColumn(name="url_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
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
     * Set interested
     *
     * @param integer $interested
     * @return History
     */
    public function setInterested($interested)
    {
        $this->interested = $interested;
    
        return $this;
    }

    /**
     * Get interested
     *
     * @return integer 
     */
    public function getInterested()
    {
        return $this->interested;
    }

    /**
     * Set user
     *
     * @param \Skim\MainBundle\Entity\User $user
     * @return History
     */
    public function setUser(\Skim\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Skim\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set url
     *
     * @param \Skim\MainBundle\Entity\Url $url
     * @return History
     */
    public function setUrl(\Skim\MainBundle\Entity\Url $url = null)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return \Skim\MainBundle\Entity\Url 
     */
    public function getUrl()
    {
        return $this->url;
    }
}