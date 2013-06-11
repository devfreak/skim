<?php

namespace Skim\MainBundle\Skim\Library\Functions;

use Skim\MainBundle\Entity\User as UserEntity;
use Doctrine\ORM\EntityManager;

class User
{

	private $user;
	private $em;

	public function setUser(UserEntity $user)
	{
		$this->user = $user;
		return $this;
	}
	public function getUser()
	{
		return $this -> user;
	}
	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
		return $this;
	}
	public function is_complete()
	{
		return count($this->user->getScores()) > 1 && $this->user->getInterests() > 1;
	}
	public function round_complete()
	{
		return $this->user->getRound() >= 1;
	}
	public function was_interested()
	{
		try 
		{

			$history = $this
				->em
				->getRepository('SkimMainBundle:History')
				->getLastUrlOfUser($this->user)
			;

	        return $history->getInterested(); 

        }
	    catch(\Doctrine\ORM\NoResultException $e) 
	    {
	        return false;
	    }
	}
	public function lasturl()
	{
		try 
		{

			$history = $this
				->em
				->getRepository('SkimMainBundle:History')
				->getLastUrlOfUser($this->user)
			;

	        return $history->getUrl(); 

        }
	    catch(\Doctrine\ORM\NoResultException $e) 
	    {
	        return false;
	    }
	}

	public function lasthistory()
	{
		try 
		{

			$history = $this
				->em
				->getRepository('SkimMainBundle:History')
				->getLastUrlOfUser($this->user)
			;

	        return $history; 

        }
	    catch(\Doctrine\ORM\NoResultException $e) 
	    {
	        return false;
	    }
	}

	public function following(UserEntity $user)
	{
		try 
		{

			$history = $this
				->em
				->getRepository('SkimMainBundle:Follower')
				->getFollowingOfFollower($user, $this->user)
			;

	        return true; 

        }
	    catch(\Doctrine\ORM\NoResultException $e) 
	    {
	        return false;
	    }
	}
}