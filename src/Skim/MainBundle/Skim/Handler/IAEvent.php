<?php

namespace Skim\MainBundle\Skim\Handler;

use Skim\MainBundle\Skim\Model\EventHandler;
use Skim\MainBundle\Entity\Follower;

class IAEvent extends EventHandler
{
	public function execute()
	{
		$user = $this
			->getService()
			->getUserFunctions()
		;

		$lasturl = $user->lasturl();

		/*
		 * mark interest
		 */
		$user
			->lasthistory()
			->setInterested(true)
		;

		/*
		 * Count Interests
		 */

		$lasturl->setInterests($lasturl->getInterests()+1);

		$user
			->getUser()
			->setInterests(
				$user->getUser()->getInterests()+1
			)
		;

		$category = $lasturl->getCategory();
		$category->setInterests($category->getInterests()+1);

		$score = $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:UserScore')
			->getScoreByCategory($lasturl->getCategory(), $this->getService()->getUser())
		;

		if(is_object($score))
		{
			$score
				->setInterests($score->getInterests()+1)
			;
		}

		/* 
		 * Not-Interests Reset
		 */
		$score = $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:UserScore')
			->getScoreByCategory($lasturl->getCategory(), $this->getService()->getUser())
		;

		if(is_object($score))
		{
			$score
				->setNotInterests(0)
			;
		}

		$lasturl->setNotInterests(0);

		/*
		 * Follower Upgrade
		 */
		if($user->following($lasturl->getUser()))
		{
			$following = $this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:Follower')
				->getFollowingOfFollower($lasturl->getUser(), $this->getService()->getUser())
			;
			if($following->getType()<2)
			{
				$following->setType($following->getType()+1);
			}
		}
		else
		{
			$following = new Follower;
			$following
				->setFollowing($lasturl->getUser())
				->setFollower($user->getUser())
			;
		}

	}
}