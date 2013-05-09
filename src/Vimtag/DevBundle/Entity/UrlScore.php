<?php

namespace Vimtag\DevBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="categoryId", type="integer")
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="percentage", type="integer")
     */
    private $percentage;

    /**
     * @var integer
     *
     * @ORM\Column(name="interests", type="integer")
     */
    private $interests;

    /**
     * @var integer
     *
     * @ORM\Column(name="urlId", type="integer")
     */
    private $urlId;


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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return UrlScore
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
     * Set urlId
     *
     * @param integer $urlId
     * @return UrlScore
     */
    public function setUrlId($urlId)
    {
        $this->urlId = $urlId;
    
        return $this;
    }

    /**
     * Get urlId
     *
     * @return integer 
     */
    public function getUrlId()
    {
        return $this->urlId;
    }
}
