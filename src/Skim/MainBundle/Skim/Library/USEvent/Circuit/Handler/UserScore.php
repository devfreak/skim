<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit\Handler;

use Skim\MainBundle\Skim\Library\USEvent\Circuit\Model\CircuitHandler;

use Skim\MainBundle\Skim\Library\Utility\WeightRand;

class UserScore extends CircuitHandler
{

	public $percentage = 0.8;

	public function execute()
	{
		$rand = new WeightRand;

		foreach($this->getService()->getUser()->getScores() as $object)
		{
			$rand->add($object->getPercentage() / 100, $object);
		}
		$handler = $rand->randObject();

		$this -> setUrl(

			$this
				->getService()
				->getEntityManager()
				->getRepository('SkimMainBundle:Url')
				->getRandomUrlFromCategoryOnRating($handler->getCategory(), $this->getService()->getUser())

		);

		return $this;

	}

}