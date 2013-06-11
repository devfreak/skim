<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit;

use Skim\MainBundle\Skim\Model\USEventHandler;
use Skim\MainBundle\Skim\Library\USEvent\Circuit\Handler;
use Skim\MainBundle\Skim\Library\USEvent\Circuit\Model\CircuitHandler;

use Skim\MainBundle\Skim\Library\Utility\WeightRand;

class Circuit extends USEventHandler
{

	private $handlers;

	private function add(CircuitHandler $handler)
	{
		$handler -> setService(
			$this -> getService()
		);
		$this -> handlers[] = $handler;
		return $this;
	}

	public function getUrl()
	{

		$this
			->add(new Handler\UserScore)
			->add(new Handler\Follower)
			->add(new Handler\ModUserScore)
			->add(new Handler\RefineExtended)
		;

		return $this
			->selectHandler()
			->execute()
			->getUrl()
		;

	}

	private function selectHandler()
	{
		$rand = new WeightRand;
		foreach($this -> handlers as $object)
			$rand -> add($object->percentage, $object);

		return $rand -> randObject();
	}

}