<?php

namespace Skim\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="interests", type="integer")
     */
    private $interests;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var boolean
     *
     * @ORM\Column(name="was_interested", type="boolean")
     */
    private $wasInterested;

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
    private $lastCat;

    /**
     * @var integer
     *
     * @ORM\Column(name="round", type="integer")
     */
    private $round;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\Url", mappedBy="user")
     */
    protected $urls;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\UserScore", mappedBy="user")
     */
    protected $scores;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\History", mappedBy="user")
     */
    protected $history;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\Follower", mappedBy="follower")
     */
    protected $following;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\Follower", mappedBy="following")
     */
    protected $followers;


    public function __construct()
    {
        parent::__construct();
        $this->interests = 0;
        $this->views = 0;
        $this->status = 0;
        $this->last_cat = 1;
        $this->round = 0;
        $this->is_interested = false;
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
     * Set interests
     *
     * @param integer $interests
     * @return User
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;
    
        return $this;
    }

    /**
     * Get interests
     *
     * @return integer 
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return User
     */
    public function setViews($views)
    {
        $this->views = $views;
    
        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set wasInterested
     *
     * @param boolean $wasInterested
     * @return User
     */
    public function setWasInterested($wasInterested)
    {
        $this->wasInterested = $wasInterested;
    
        return $this;
    }

    /**
     * Get wasInterested
     *
     * @return boolean 
     */
    public function getWasInterested()
    {
        return $this->wasInterested;
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
     * Set lastCat
     *
     * @param integer $lastCat
     * @return User
     */
    public function setLastCat($lastCat)
    {
        $this->lastCat = $lastCat;
    
        return $this;
    }

    /**
     * Get lastCat
     *
     * @return integer 
     */
    public function getLastCat()
    {
        return $this->lastCat;
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
     * Add urls
     *
     * @param \Skim\MainBundle\Entity\Url $urls
     * @return User
     */
    public function addUrl(\Skim\MainBundle\Entity\Url $urls)
    {
        $this->urls[] = $urls;
    
        return $this;
    }

    /**
     * Remove urls
     *
     * @param \Skim\MainBundle\Entity\Url $urls
     */
    public function removeUrl(\Skim\MainBundle\Entity\Url $urls)
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
     * @param \Skim\MainBundle\Entity\UserScore $scores
     * @return User
     */
    public function addScore(\Skim\MainBundle\Entity\UserScore $scores)
    {
        $this->scores[] = $scores;
    
        return $this;
    }

    /**
     * Remove scores
     *
     * @param \Skim\MainBundle\Entity\UserScore $scores
     */
    public function removeScore(\Skim\MainBundle\Entity\UserScore $scores)
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
     * Add history
     *
     * @param \Skim\MainBundle\Entity\History $history
     * @return User
     */
    public function addHistory(\Skim\MainBundle\Entity\History $history)
    {
        $this->history[] = $history;
    
        return $this;
    }

    /**
     * Remove history
     *
     * @param \Skim\MainBundle\Entity\History $history
     */
    public function removeHistory(\Skim\MainBundle\Entity\History $history)
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

    /**
     * Add following
     *
     * @param \Skim\MainBundle\Entity\Follower $following
     * @return User
     */
    public function addFollowing(\Skim\MainBundle\Entity\Follower $following)
    {
        $this->following[] = $following;
    
        return $this;
    }

    /**
     * Remove following
     *
     * @param \Skim\MainBundle\Entity\Follower $following
     */
    public function removeFollowing(\Skim\MainBundle\Entity\Follower $following)
    {
        $this->following->removeElement($following);
    }

    /**
     * Get following
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * Add followers
     *
     * @param \Skim\MainBundle\Entity\Follower $followers
     * @return User
     */
    public function addFollower(\Skim\MainBundle\Entity\Follower $followers)
    {
        $this->followers[] = $followers;
    
        return $this;
    }

    /**
     * Remove followers
     *
     * @param \Skim\MainBundle\Entity\Follower $followers
     */
    public function removeFollower(\Skim\MainBundle\Entity\Follower $followers)
    {
        $this->followers->removeElement($followers);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowers()
    {
        return $this->followers;
    }
}