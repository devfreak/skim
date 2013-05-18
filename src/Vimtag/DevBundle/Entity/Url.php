<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Url
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vimtag\DevBundle\Entity\UrlRepository")
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\User", inversedBy="urls")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Vimtag\DevBundle\Entity\UrlScore", mappedBy="url")
     */
    protected $scores;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\Category", inversedBy="categories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToOne(targetEntity="Vimtag\DevBundle\Entity\History", mappedBy="url")
     */
    private $history;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \Vimtag\DevBundle\Entity\User $user
     * @return Url
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
     * Add scores
     *
     * @param \Vimtag\DevBundle\Entity\UrlScore $scores
     * @return Url
     */
    public function addScore(\Vimtag\DevBundle\Entity\UrlScore $scores)
    {
        $this->scores[] = $scores;
    
        return $this;
    }

    /**
     * Remove scores
     *
     * @param \Vimtag\DevBundle\Entity\UrlScore $scores
     */
    public function removeScore(\Vimtag\DevBundle\Entity\UrlScore $scores)
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
     * @param \Vimtag\DevBundle\Entity\Category $category
     * @return Url
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
     * Set history
     *
     * @param \Vimtag\DevBundle\Entity\History $history
     * @return Url
     */
    public function setHistory(\Vimtag\DevBundle\Entity\History $history = null)
    {
        $this->history = $history;
    
        return $this;
    }

    /**
     * Get history
     *
     * @return \Vimtag\DevBundle\Entity\History 
     */
    public function getHistory()
    {
        return $this->history;
    }
}