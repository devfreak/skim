<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UrlScore
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\Category", inversedBy="scores")
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
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\Url", inversedBy="scores")
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
     * Set percentage
     *
     * @param integer $percentage
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

    /**
     * Set category
     *
     * @param \Vimtag\DevBundle\Entity\Category $category
     * @return UrlScore
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
     * Set url
     *
     * @param \Vimtag\DevBundle\Entity\Url $url
     * @return UrlScore
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

    /**
     * Set not_interest
     *
     * @param integer $notInterest
     * @return UrlScore
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