<?php

namespace Skim\MainBundle\Skim\Model;

use Skim\MainBundle\Skim\LogicService;
use Skim\MainBundle\Skim\Model\Event;

abstract class EventHandler
{
	
	abstract function execute();

	private $events;
	private $service;
	private $response;

	public function __construct()
	{
		$this -> events = array();
	}

	public function setService(LogicService $service)
	{
		$this -> service = $service;
	}

	protected function getService()
	{
		return $this->service;
	}

	public function getResponse()
	{
		return $this->response;
	}

	protected function setResponse($response)
	{
		$this -> response = $response;
	}

}