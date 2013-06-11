<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit\Handler;

use Skim\MainBundle\Skim\Library\USEvent\Circuit\Model\CircuitHandler;

class RefineExtended extends CircuitHandler
{

	public $percentage = 0.02;

	public function execute()
	{
		$ue = $this->getService()->getUser();

		$ue -> setLastcat($ue->getLastcat()+1);

		if(!$this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:Category')
			->exists($ue->getLastcat())
		)
			$ue -> setLastcat(1);

		$category = $this
			->getService()
			->getUser()
			->getLastcat()
		;

		$category = $this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:Category')
			->find($category)
		;

		$this->setUrl( 
			$this
			->getService()
			->getEntityManager()
			->getRepository('SkimMainBundle:Url')
			->getBestUrlofCategory($category)
		);
		return $this;
	}
}