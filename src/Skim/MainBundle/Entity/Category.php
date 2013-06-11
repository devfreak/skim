<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\CategoryRepository")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\UrlScore", mappedBy="category")
     */
    protected $scores;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\Url", mappedBy="category")
     */
    protected $urls;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\UserScore", mappedBy="category")
     */
    protected $userScores;

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
     * Set views
     *
     * @param integer $views
     * @return Category
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
     * Set interests
     *
     * @param integer $interests
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->scores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->urls = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userScores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interests = 0;
    }
    
    /**
     * Add scores
     *
     * @param \Skim\MainBundle\Entity\UrlScore $scores
     * @return Category
     */
    public function addScore(\Skim\MainBundle\Entity\UrlScore $scores)
    {
        $this->scores[] = $scores;
    
        return $this;
    }

    /**
     * Remove scores
     *
     * @param \Skim\MainBundle\Entity\UrlScore $scores
     */
    public function removeScore(\Skim\MainBundle\Entity\UrlScore $scores)
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
     * Add urls
     *
     * @param \Skim\MainBundle\Entity\Url $urls
     * @return Category
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
     * Add userScores
     *
     * @param \Skim\MainBundle\Entity\UserScore $userScores
     * @return Category
     */
    public function addUserScore(\Skim\MainBundle\Entity\UserScore $userScores)
    {
        $this->userScores[] = $userScores;
    
        return $this;
    }

    /**
     * Remove userScores
     *
     * @param \Skim\MainBundle\Entity\UserScore $userScores
     */
    public function removeUserScore(\Skim\MainBundle\Entity\UserScore $userScores)
    {
        $this->userScores->removeElement($userScores);
    }

    /**
     * Get userScores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserScores()
    {
        return $this->userScores;
    }
}