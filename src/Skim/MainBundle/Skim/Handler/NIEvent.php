<?php

namespace Skim\MainBundle\Skim\Handler;

use Skim\MainBundle\Skim\Model\EventHandler;
use Skim\MainBundle\Skim\Library\Utility\Round;

use Skim\MainBundle\Skim\Library\Functions\User; 

class NIEvent extends EventHandler
{

	public function execute()
	{
		$user = $this
			->getService()
			->getUserFunctions()
		;

		$lasturl = $user->lasturl();

		if(!$user->was_interested() && is_object($lasturl))
		{


			/*
			 * Downgrade Followers
			 */
			if($user->following($lasturl->getUser()))
			{
				$following = $this
					->getService()
					->getEntityManager()
					->getRepository('SkimMainBundle:Follower')
					->getFollowingOfFollower($lasturl->getUser(), $this->getService()->getUser())
				;

				$following
					->setNotInterests($following->getNotInterests()+1)
				;

				if(
					($following->getType()==0&&$following->getNotInterests()>=4)
					OR ($following->getType()==1&&$following->getNotInterests()>= 10)
				)
				{
					$this
						->getService()
						->getEntityManager()
						->remove($following)
					;
				}
			}


			/*
			 * Downgrade Score
			 */
			$score = $this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:UserScore')
				->getScoreByCategory($lasturl->getCategory(), $this->getService()->getUser())
			;

			if(!$score == false)
			{
				$score
					->setNotInterests($score->getNotInterests()+1)
				;

				if($score->getNotInterests()>=4)
				{
					$score->setNotinterests(0);
					$score
						->setPercentage($score->getPercentage()-2)
					;
					$quotient = 2 / ($this
						->getService()
						->getEntityManager()
						->getRepository('SkimMainBundle:UserScore')
						->countScoresFromUser($this->getService()->getUser())-1)
					;
					foreach($this->getService()->getUser()->getScores() as $object)
					{
						if($object !== $score)
							$object->setPercentage($object->getPercentage()+$quotient);
					}
					$round = new Round;
					$round
						->setRepository($this
							->getService()
							->getEntityManager()
							->getRepository('SkimMainBundle:UserScore')
						)
						->setObject($this->getService()->getUser())
						->round()
					;
				}
			}

			/*
			 * Downgrade URL
			 */

			$lasturl
				->setNotInterests($lasturl->getNotInterests()+1)
			;

			if($lasturl -> getNotInterests() > (9+$lasturl->getInterests()))
			{

				$this
					->getService()
					->getEntityManager()
					->remove($lasturl)
				;

			}


		}
	}

}