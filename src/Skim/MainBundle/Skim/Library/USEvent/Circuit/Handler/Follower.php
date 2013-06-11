<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit\Handler;

use Skim\MainBundle\Skim\Library\USEvent\Circuit\Model\CircuitHandler;

class Follower extends CircuitHandler
{

	public $percentage = 0.1;

	public function execute()
	{

		$this->setUrl(
			$this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:Url')
				->getNewestUrlFromFollowing($this->getService()->getUser())
		);
		return $this;
	}
}