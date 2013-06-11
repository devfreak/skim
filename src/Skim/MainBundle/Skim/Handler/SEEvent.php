<?php

namespace Skim\MainBundle\Skim\Handler;

use Skim\MainBundle\Skim\Model\EventHandler;
use Skim\MainBundle\Skim\Library\Utility\Exchange;
use Skim\MainBundle\Skim\Library\Utility\Round;

use Skim\MainBundle\Entity\UserScore;
use Skim\MainBundle\Entity\UrlScore;

class SEEvent extends EventHandler
{
	public function execute()
	{

		$user = $this
			->getService()
			->getUserFunctions()
		;

		$url_parent = $user->lasturl()->getScores();
		$user_parent = $user->getUser()->getScores();

		// Score Exchange
		$exchange = new Exchange;
		$exchange
			->setEntityManager($this->getService()->getEntityManager())
		;

		// From User To Url
		$exchange->setChildRepository(
				$this
					->getService()
					->getEntityManager()
					->getRepository('SkimMainBundle:UrlScore')
			)
			->setChildObject($user->lasturl())
			->setChildInstance(new UrlScore)
			->setParent($user_parent, $user->getUser()->getInterests())
			->setChild($user->lasturl()->getScores(), $user->lasturl()->getInterests())
			->execute()
		;

		// From Url To User
		$exchange
			->setChildRepository(
				$this
					->getService()
					->getEntityManager()
					->getRepository('SkimMainBundle:UserScore')
			)
			->setChildObject($user->getUser())
			->setChildInstance(new UserScore)
			->setParent($url_parent, $user->lasturl()->getInterests())
			->setChild($user->getUser()->getScores(), $user->getUser()->getInterests())
			->execute()
		;

		/*
		 * Round
		 */

		$round = new Round;

		$round
			->setRepository(
				$this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:UrlScore')
			)
			->setObject($user->lasturl())
			->round()
		;

		$round
			->setRepository(
				$this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:UserScore')
			)
			->setObject($user->getUser())
			->round()
		;

	}
}