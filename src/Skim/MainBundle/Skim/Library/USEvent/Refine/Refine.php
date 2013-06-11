<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Refine;

use Skim\MainBundle\Skim\Model\USEventHandler;
use Skim\MainBundle\Skim\Library\Functions\User;

class Refine extends USEventHandler
{
	public function getUrl()
	{

		$user = new User;
		$ue = $this->getService()->getUser();

		$user -> setUser($ue);

		if($user -> round_complete())
		{
			$ue -> setLastcat($ue->getLastcat()+1);

			if(!$this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:Category')
				->exists($ue->getLastcat()+7)
			)

				$ue -> setLastcat(1);

			$ue -> setRound(0);
		}
		else
		{
			$ue -> setRound($ue->getRound()+1);
		}

		$category = $this
			->getService()
			->getUser()
			->getLastcat()+7
		;

		$category = $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:Category')
			->find($category)
		;

		return $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:Url')
			->getBestUrlofCategory($category)
		;

	}
}