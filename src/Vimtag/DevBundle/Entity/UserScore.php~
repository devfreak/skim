<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserScore
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Vimtag\DevBundle\Entity\UserScoreRepository")
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
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\Category", inversedBy="userScores")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var float
     *
     * @ORM\Column(name="percentage", type="float")
     */
    private $percentage;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\User", inversedBy="scores")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="not_interest", type="integer")
     */
    private $not_interest;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->not_interest = 0;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return UserScore
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    
        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set percentage
     *
     * @param integer $percentage
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
     * @return integer 
     */
    public function getPercentage()
    {
        return $this->percentage;
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

    /**
     * Set userId
     *
     * @param integer $userId
     * @return UserScore
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user
     *
     * @param \Vimtag\DevBundle\Entity\User $user
     * @return UserScore
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
     * Set lastvisit
     *
     * @param integer $lastvisit
     * @return UserScore
     */
    public function setLastvisit($lastvisit)
    {
        $this->lastvisit = $lastvisit;
    
        return $this;
    }

    /**
     * Get lastvisit
     *
     * @return integer 
     */
    public function getLastvisit()
    {
        return $this->lastvisit;
    }

    /**
     * Set category
     *
     * @param \Vimtag\DevBundle\Entity\Category $category
     * @return UserScore
     */
    public function setCategory(\Vimtag\DevBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Vimtag\DevBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set not_interest
     *
     * @param integer $notInterest
     * @return UserScore
     */
    public function setNotInterest($notInterest)
    {
        $this->not_interest = $notInterest;
    
        return $this;
    }

    /**
     * Get not_interest
     *
     * @return integer 
     */
    public function getNotInterest()
    {
        return $this->not_interest;
    }
}