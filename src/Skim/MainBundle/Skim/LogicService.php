<?php

namespace Skim\MainBundle\Skim;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

use Skim\MainBundle\Skim\Library\Functions\User;

class LogicService
{

	private $em;
	private $container;

	public function getEntityManager()
	{
		return $this->em;
	}

	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
		return $this;
	}

	public function getContainer()
	{
		return $this->container;
	}

	public function setContainer(Container $container)
	{
		$this->container = $container;
		return $this;
	}

	public function getUser()
	{
		return $this
			->getContainer()
			->get('security.context')
			->getToken()
			->getUser()
		;
	}

	public function getUserFunctions()
	{
		$user = new User;
		return $user
			->setUser($this->getUser())
			->setEntityManager($this->em)
		;
	}

}