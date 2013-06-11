<?php

namespace Skim\MainBundle\Skim\Handler;

use Skim\MainBundle\Skim\Model\EventHandler;

class GBEvent extends EventHandler
{

	public function execute()
	{

		$this
			->getService()
			->getEntityManager()
			->flush()
		;
	}

}