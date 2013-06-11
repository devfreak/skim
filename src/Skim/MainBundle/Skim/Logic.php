<?php

namespace Skim\MainBundle\Skim;

use Symfony\Component\HttpFoundation\JSONResponse;
use Skim\MainBundle\Skim\LogicService;
use Skim\MainBundle\Skim\Model\EventHandler;

class Logic
{

	private $service;
	private $handlers;
	private $response;

	public function __construct()
	{
		$this -> service = new LogicService;
		$this -> response = new JSONResponse(array('success' => true));
	}

	public function getService()
	{
		return $this->service;
	}

	public function addHandler(EventHandler $handler)
	{

		$handler -> setService(
			$this->service
		);

		$this -> handlers[] = $handler;

		return $this;

	}

	public function execute()
	{

		foreach($this -> handlers as $handler)
		{
			$handler -> execute();
			if($handler->getResponse() !== null)
				$this -> setResponse($handler->getResponse());
		}
		return $this;

	}

	private function setResponse($response)
	{

		$this -> response = $response;

	}

	public function getResponse()
	{
		return $this -> response;
	}

}