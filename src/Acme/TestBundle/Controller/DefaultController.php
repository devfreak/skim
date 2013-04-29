<?php

namespace Acme\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/test")
 */
class DefaultController extends Controller
{
	/**
	 * @Route("/")
	 */
    public function indexAction()
    {
        return new Response();
    }
}
