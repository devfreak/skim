<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vimtag_user")
 * @ORM\Entity(repositoryClass="Vimtag\DevBundle\Entity\UserRepository")
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
     * @ORM\Column(name="is_interested", type="boolean")
     */
    private $is_interested;

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

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\Follower", mappedBy="follower")
     */
    protected $following;

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\Follower", mappedBy="following")
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
     * Set is_interested
     *
     * @param boolean $isInterested
     * @return User
     */
    public function setIsInterested($isInterested)
    {
        $this->is_interested = $isInterested;
    
        return $this;
    }

    /**
     * Get is_interested
     *
     * @return boolean 
     */
    public function getIsInterested()
    {
        return $this->is_interested;
    }

    /**
     * Add following
     *
     * @param \Vimtag\DevBundle\Entity\Follower $following
     * @return User
     */
    public function addFollowing(\Vimtag\DevBundle\Entity\Follower $following)
    {
        $this->following[] = $following;
    
        return $this;
    }

    /**
     * Remove following
     *
     * @param \Vimtag\DevBundle\Entity\Follower $following
     */
    public function removeFollowing(\Vimtag\DevBundle\Entity\Follower $following)
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
     * @param \Vimtag\DevBundle\Entity\Follower $followers
     * @return User
     */
    public function addFollower(\Vimtag\DevBundle\Entity\Follower $followers)
    {
        $this->followers[] = $followers;
    
        return $this;
    }

    /**
     * Remove followers
     *
     * @param \Vimtag\DevBundle\Entity\Follower $followers
     */
    public function removeFollower(\Vimtag\DevBundle\Entity\Follower $followers)
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