<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vimtag_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_cat", type="integer")
     */
    private $last_cat;

    /**
     * @var integer
     *
     * @ORM\Column(name="round", type="integer")
     */
    private $round;

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\Url", mappedBy="user")
     */
    protected $urls;

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\UserScore", mappedBy="user")
     */
    protected $scores;

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\History", mappedBy="user")
     */
    protected $history;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Add urls
     *
     * @param \Vimtag\DevBundle\Entity\Url $urls
     * @return User
     */
    public function addUrl(\Vimtag\DevBundle\Entity\Url $urls)
    {
        $this->urls[] = $urls;
    
        return $this;
    }

    /**
     * Remove urls
     *
     * @param \Vimtag\DevBundle\Entity\Url $urls
     */
    public function removeUrl(\Vimtag\DevBundle\Entity\Url $urls)
    {
        $this->urls->removeElement($urls);
    }

    /**
     * Get urls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Add scores
     *
     * @param \Vimtag\DevBundle\Entity\UserScore $scores
     * @return User
     */
    public function addScore(\Vimtag\DevBundle\Entity\UserScore $scores)
    {
        $this->scores[] = $scores;
    
        return $this;
    }

    /**
     * Remove scores
     *
     * @param \Vimtag\DevBundle\Entity\UserScore $scores
     */
    public function removeScore(\Vimtag\DevBundle\Entity\UserScore $scores)
    {
        $this->scores->removeElement($scores);
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set last_cat
     *
     * @param integer $lastCat
     * @return User
     */
    public function setLastCat($lastCat)
    {
        $this->last_cat = $lastCat;
    
        return $this;
    }

    /**
     * Get last_cat
     *
     * @return integer 
     */
    public function getLastCat()
    {
        return $this->last_cat;
    }

    /**
     * Set round
     *
     * @param integer $round
     * @return User
     */
    public function setRound($round)
    {
        $this->round = $round;
    
        return $this;
    }

    /**
     * Get round
     *
     * @return integer 
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Add history
     *
     * @param \Vimtag\DevBundle\Entity\History $history
     * @return User
     */
    public function addHistory(\Vimtag\DevBundle\Entity\History $history)
    {
        $this->history[] = $history;
    
        return $this;
    }

    /**
     * Remove history
     *
     * @param \Vimtag\DevBundle\Entity\History $history
     */
    public function removeHistory(\Vimtag\DevBundle\Entity\History $history)
    {
        $this->history->removeElement($history);
    }

    /**
     * Get history
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistory()
    {
        return $this->history;
    }
}