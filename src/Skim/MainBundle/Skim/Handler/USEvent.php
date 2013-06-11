<?php

namespace Skim\MainBundle\Skim\Handler;

use Skim\MainBundle\Skim\Model\EventHandler;
use Skim\MainBundle\Skim\Library\USEvent\Circuit\Circuit;
use Skim\MainBundle\Skim\Library\USEvent\Refine\Refine;

use Skim\MainBundle\Entity\UserScore;
use Skim\MainBundle\Entity\History;

use Symfony\Component\HttpFoundation\JSONResponse;
use Skim\MainBundle\Skim\Library\Functions\User;

class USEvent extends EventHandler
{

	public function execute()
	{

		$user = $this
			->getService()
			->getUserFunctions()
		;

		if($user -> is_complete())
		{
			
			$circuit = new Circuit($this->getService());

			$result = $circuit -> getUrl();

		}
		else
		{

			$refine = new Refine($this->getService());

			$result = $refine -> getUrl();

		}

		$score = $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:UserScore')
			->getScoreByCategory($result->getCategory(), $this->getService()->getUser())
		;

		if(!$score)
		{
			$score = new UserScore;
			$score 
				-> setCategory($result->getCategory())
				-> setPercentage(0)
				-> setViews(0)
				-> setUser($this->getService()->getUser())
			;
			$this
				->getService()
				->getUser()
				->addScore($score)
			;
			$this
				->getService()
				->getEntityManager()
				->persist($score)
			;
		}
		else
		{
			$score -> setViews($score -> getViews()+1);
		}

		$result
			->setViews($result->getViews()+1)
		;

		$result
			->getCategory()
			->setViews($result->getCategory()->getViews()+1)
		;

		$this
			->getService()
			->getUser()
			->setViews($this->getService()->getUser()->getViews()+1)
		;

		$history = new History;
		$history
			->setUrl($result)
			->setUser($this -> getService() -> getUser())
			->setInterested(false)
		;

		$this
			->getService()
			->getEntityManager()
			->persist($history)
		;

		$this
			->setResponse(
				new JSONResponse(array('url' => $result->getUrl()))
			)
		;

	}

}