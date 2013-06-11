<?php

namespace Skim\MainBundle\Skim\Library\USEvent\Circuit\Model;

use Skim\MainBundle\Skim\LogicService;

use Skim\MainBundle\Entity\UserScore;
use Skim\MainBundle\Entity\Category;
use Skim\MainBundle\Entity\Url;

abstract class CircuitHandler
{

	abstract public function execute();

	private $service;
	private $url;

	protected function getService()
	{
		return $this -> service;
	}

	public function setService($service)
	{
		$this -> service = $service;
	}

	public function getUrl()
	{
		return $this->url;
	}

	protected function setUrl(Url $url)
	{
		$this -> url = $url;
	}

}