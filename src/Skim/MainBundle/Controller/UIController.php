<?php

namespace Skim\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/dev")
 */
class UIController extends Controller
{
    /**
     * @Route("/")
     * @Template("SkimMainBundle:UI:main.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
