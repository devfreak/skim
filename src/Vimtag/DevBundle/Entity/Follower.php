<?php

namespace Vimtag\DevBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follower
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Follower
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
     * @ORM\Column(name="type", type="integer", length=1)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="round", type="integer", length=2)
     */
    private $round;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\User", inversedBy="following")
     * @ORM\JoinColumn(name="follower_id", referencedColumnName="id")
     */
    protected $follower;

    /**
     * @ORM\ManyToOne(targetEntity="Vimtag\DevBundle\Entity\User", inversedBy="followers")
     * @ORM\JoinColumn(name="following_id", referencedColumnName="id")
     */
    protected $following;


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
     * Set type
     *
     * @param integer $type
     * @return Follower
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set round
     *
     * @param integer $round
     * @return Follower
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
     * Set follower
     *
     * @param \Vimtag\DevBundle\Entity\User $follower
     * @return Follower
     */
    public function setFollower(\Vimtag\DevBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;
    
        return $this;
    }

    /**
     * Get follower
     *
     * @return \Vimtag\DevBundle\Entity\User 
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set following
     *
     * @param \Vimtag\DevBundle\Entity\User $following
     * @return Follower
     */
    public function setFollowing(\Vimtag\DevBundle\Entity\User $following = null)
    {
        $this->following = $following;
    
        return $this;
    }

    /**
     * Get following
     *
     * @return \Vimtag\DevBundle\Entity\User 
     */
    public function getFollowing()
    {
        return $this->following;
    }
}