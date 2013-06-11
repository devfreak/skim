<?php

namespace Skim\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Skim\MainBundle\Skim\Logic;

use Skim\MainBundle\Skim\Handler;

/**
 * @Route("dev/")
 */
class InterestController extends Controller
{
	/**
	 * @Route("interest")
	 */
	public function interestAction()
	{

		$logic = new Logic;

		$logic
			->getService()
			->setEntityManager($this->getDoctrine()->getEntityManager())
			->setContainer($this->container)
		;

		$logic

			->addHandler(new Handler\IAEvent)
			->addHandler(new Handler\SEEvent)
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