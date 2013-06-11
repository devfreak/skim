<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserScore
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\UserScoreRepository")
 */
class UserScore
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
     * @var float
     *
     * @ORM\Column(name="percentage", type="float")
     */
    private $percentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="not_interests", type="integer")
     */
    private $notInterests;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var integer
     *
     * @ORM\Column(name="interests", type="integer")
     */
    private $interests;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\Category", inversedBy="userScores")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\User", inversedBy="scores")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    public function __construct()
    {
        $this->notInterests = 0;
        $this->views = 0;
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
     * Set percentage
     *
     * @param float $percentage
     * @return UserScore
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    
        return $this;
    }

    /**
     * Get percentage
     *
     * @return float 
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set notInterests
     *
     * @param integer $notInterests
     * @return UserScore
     */
    public function setNotInterests($notInterests)
    {
        $this->notInterests = $notInterests;
    
        return $this;
    }

    /**
     * Get notInterests
     *
     * @return integer 
     */
    public function getNotInterests()
    {
        return $this->notInterests;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return UserScore
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
     * Set category
     *
     * @param \Skim\MainBundle\Entity\Category $category
     * @return UserScore
     */
    public function setCategory(\Skim\MainBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Skim\MainBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \Skim\MainBundle\Entity\User $user
     * @return UserScore
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
     * Set user
     *
     * @param \Skim\MainBundle\Entity\User $user
     * @return UserScore
     */
    public function setObject(\Skim\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Skim\MainBundle\Entity\User 
     */
    public function getObject()
    {
        return $this->user;
    }

    /**
     * Set interests
     *
     * @param integer $interests
     * @return UserScore
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
}