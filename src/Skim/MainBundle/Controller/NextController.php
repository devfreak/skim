<?php

namespace Skim\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Skim\MainBundle\Skim\Logic;

use Skim\MainBundle\Skim\Handler;

class NextController extends Controller
{
	/**
	 * @Route("dev/next")
	 */
	public function nextAction()
	{

		$logic = new Logic;

		$logic
			->getService()
			->setEntityManager(
				$this
					->getDoctrine()
					->getEntityManager()
			)
			->setContainer(
				$this->container
			)
		;
		$logic

			->addHandler(new Handler\USEvent)
			->addHandler(new Handler\NIEvent)
			->addHandler(new Handler\GBEvent)

		;

		try
		{
			
			return $logic
				->execute()
				->getResponse()
			;

		}
		catch(ELogicException $e)
		{
			//
		}

	}
}