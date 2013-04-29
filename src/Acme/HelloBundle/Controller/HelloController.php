<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\HelloBundle\Entity\Optin;
use Acme\HelloBundle\Form\OptinType;


/**
 * @Route("/hello")
 */
class HelloController extends Controller
{

	/**
	 * @Route("/")
	 */
	public function indexAction()
	{

		$optin = new Optin;
		$optin->setEMail('Your EMail adress');
        $form = $this->createForm(new OptinType, $optin);

        $message = \Swift_Message::newInstance()
	        ->setSubject('Hello Email')
	        ->setFrom('noreply@vimtag.com')
	        ->setTo('plevints@gmx.de')
	        ->setBody(
	            'Hallo, Dennis. Du hast voll die geilen Muskeln!'
	        )
	    ;
	    $this->get('mailer')->send($message);

		return $this->render("HelloBundle:Hello:index.html.twig",
							 array(
							 	"form" => $form->createView()
							 ));
	}

	/**
	 * @Route("/optin", name="optin2", options={"expose"=true})
	 * @Method({"POST"})
	 */
	public function optinAction(Request $request) {

		$response = array('success' => false);
		$form = $this->createForm(new OptinType, new Optin);

		$form->bindRequest($request);

		if($form->hasErrors())
			$reponse['message'] = $form->getErrorsAsString();

		else if($form->isValid())
		{

			if(filter_var($request->get('email'), FILTER_VALIDATE_EMAIL))
			{
				
			}
			else 
				$response['message'] = 'Invalid E-Mail address.';

		}

		return new JsonResponse(array(
            'success' => $response['success'],
            'text' => $response['message']
        ));
	}

}
