<?php

namespace Skim\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UrlScore
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skim\MainBundle\Entity\UrlScoreRepository")
 */
class UrlScore
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
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\Url", inversedBy="scores")
     * @ORM\JoinColumn(name="url_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Skim\MainBundle\Entity\Category", inversedBy="scores")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    public function __construct()
    {
        $this->interests = 0;
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
     * @return UrlScore
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
     * Set url
     *
     * @param \Skim\MainBundle\Entity\Url $url
     * @return UrlScore
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

    /**
     * Set url
     *
     * @param \Skim\MainBundle\Entity\Url $url
     * @return UrlScore
     */
    public function setObject(\Skim\MainBundle\Entity\Url $url = null)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return \Skim\MainBundle\Entity\Url 
     */
    public function getObject()
    {
        return $this->url;
    }

    /**
     * Set category
     *
     * @param \Skim\MainBundle\Entity\Category $category
     * @return UrlScore
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
     * Set views
     *
     * @param integer $views
     * @return UrlScore
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
     * @return UrlScore
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