<?php

namespace Skim\MainBundle\Skim\Model;

use Skim\MainBundle\Skim\LogicService;

class Event
{

	private $service;

	public function __construct(LogicService $service)
	{
		$this -> setService($service);
	}

	public function setService(LogicService $service)
	{
		$this -> service = $service;
		return $this;
	}

	protected function getService()
	{
		return $this -> service;
	}
	
}