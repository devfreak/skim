<?php

namespace Skim\MainBundle\Skim\Library\Utility;

use Skim\MainBundle\Entity;

class Round
{

	private $repository;
	private $obj;

	public function setRepository($repository)
	{
		$this -> repository = $repository;
		return $this;
	}

	public function setObject($obj)
	{
		$this -> obj = $obj;
		return $this;
	}

	public function round()
	{
		$sum = 0;
		foreach($this->obj->getScores() as $score)
		{
			$score->setPercentage(
				round($score->getPercentage(), 2)
			);
			$sum += $score->getPercentage();
		}
		
		$difference = 100 - $sum;

		$highest = $this
			->repository
			->getHighestScoreOfObject($this->obj)
		;

		$highest->setPercentage(
			$highest->getPercentage() + $difference
		);
	}

}