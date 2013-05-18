<?php

namespace Vimtag\DevBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends BaseSecurityController
{
    public function loginAction()
    {
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return new RedirectResponse('/dev');
        }
        
        return parent::loginAction();
    }
}