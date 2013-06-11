<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Url
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\UrlRepository")
 */
class Url
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
     * @ORM\Column(name="url", type="string", length=1000)
     */
    private $url;

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
     * @var integer
     *
     * @ORM\Column(name="not_interests", type="integer")
     */
    private $notInterests;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\User", inversedBy="urls")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\UrlScore", mappedBy="url", cascade={"persist", "remove"})
     */
    protected $scores;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\Category", inversedBy="categories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="Skim\MainBundle\Entity\History", mappedBy="url", cascade={"remove"}, orphanRemoval=true)
     */
    private $history;

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
     * Set url
     *
     * @param string $url
     * @return Url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set interests
     *
     * @param integer $interests
     * @return Url
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
     * @return Url
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
     * Set notInterests
     *
     * @param integer $notInterests
     * @return Url
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
     * Constructor
     */
    public function __construct()
    {
        $this->scores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->history = new \Doctrine\Common\Collections\ArrayCollection();

        $this->notInterests = 0;
    }
    
    /**
     * Set user
     *
     * @param \Skim\MainBundle\Entity\User $user
     * @return Url
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
     * Add scores
     *
     * @param \Skim\MainBundle\Entity\UrlScore $scores
     * @return Url
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
     * Set category
     *
     * @param \Skim\MainBundle\Entity\Category $category
     * @return Url
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
     * Add history
     *
     * @param \Skim\MainBundle\Entity\History $history
     * @return Url
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
}