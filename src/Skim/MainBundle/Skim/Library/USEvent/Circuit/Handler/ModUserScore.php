<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit\Handler;

use Skim\MainBundle\Skim\Library\USEvent\Circuit\Model\CircuitHandler;
use Skim\MainBundle\Skim\Library\Utility\WeightRand;

class ModUserScore extends CircuitHandler
{

	public $percentage = 0.08;

	public function execute()
	{

		$rand = new WeightRand;

		$sum = 0;
		
		foreach($this->getService()->getUser()->getScores() as $object)
		{
			$sum += ($object -> getInterests() ^ 2) / $object->getViews();
		}

		foreach($this->getService()->getUser()->getScores() as $object)
		{
			$rand->add(($object -> getInterests() ^ 2) / $object->getViews() / $sum, $object);
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