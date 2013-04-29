<?php

namespace Acme\StartUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Acme\StartUpBundle\Entity\OptinTask;
use Acme\StartUpBundle\Entity\OptinData;
use Acme\StartUpBundle\Form\OptinType;
use Symfony\Component\Routing\RequestContext;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
	/**
	 * @Route("/", name="index")
	 */
    public function indexAction()
    {
    	$optin = new OptinTask;
		$optin->setEMail('Your EMail adress');
        $form = $this->createForm(new OptinType, $optin);

        return $this->render('AcmeStartUpBundle:Default:index.html.twig',
        					 array(
        					 	'form' => $form->createView()
        					 ));
    }

    /**
     * @Route("/optin/", name="optin", options={"expose"=true})
	 * @Method({"POST"})
     */
    public function optinAction(Request $request) 
    {

    	$response = array('success' => false);
		$form = $this->createForm(new OptinType, new OptinTask);

		$form->bindRequest($request);

		if($form->hasErrors())
			$reponse['message'] = $form->getErrorsAsString();

		else if($form->isValid())
		{

			$email = $form['email']->getData();

			# create activation key
			$secretKey = 's=2ldf$$%sdkv**fdk//"JSndkJlLkdjaÖskgfhdjKSJn5729386fjdkdlghsdjfn' . md5(rand(0,45345));
			$key = md5(urlencode($email).$secretKey);

			$optin = new OptinData;
			$optin->setEmail($email);
			$optin->setKey($key);
			$optin->setActivated(false);

		    $validator = $this->get('validator');
		    $errors = $validator->validate($optin);

        	if(count($errors) > 0)
        		$response['message'] = $errors[0]->getMessage();

        	else
        	{
				$doctrine = $this->getDoctrine()->getManager();

				$doctrine->persist($optin);
				$doctrine->flush();

				$message = \Swift_Message::newInstance()
				       ->setSubject('Thanks for joining us!')
				       ->setFrom(array('noreply@vimtag.com' => 'Vimtag'))
				       ->setTo($email)
				       ->setBody(
				            'Thank you for your interest in Vimtag. Click here to confirm your email address.'."\n".
				            $this->get('router')
				           		 ->generate('verify', 
				           			   	    array(
				           			   	    	'key' => $key,
				           			   	        'email' => urlencode($email)      
				           			   	        ), 
				           			        true
				                            ).
				           	"\nHope to hear from you soon.\n".
				           	"Vimtag"
				         )
				;
					   
			    $this->get('mailer')->send($message);

				$response['message'] = 'Confirmation has been sent to your email address';
				$response['success'] = true;
			
			}

		}

		return new JsonResponse(array(
            'success' => $response['success'],
            'text' => $response['message']
        ));

    }

    /**
     * @Route("/verify/{key}/{email}", name="verify")
     * @Method({"GET"})
     */
    public function verifyAction($key, $email)
    {

    	$server = $this->getDoctrine()->getManager();

    	$obj = $this->getDoctrine()
        ->getRepository('AcmeStartUpBundle:OptinData')
        ->findOneByEmail(urldecode($email));

        if(!$obj)
        	return $this->redirect($this->generateUrl('index'));

        else
        {

        	if($obj->getKey() == $key)
        	{
        		$obj->setActivated(true);
        		$server->flush();
        		return $this->render('AcmeStartUpBundle:Default:finish.html.twig');
        	}
        	else
        	{
        		return $this->redirect($this->generateUrl('index'));
        	}

        }
    }
}
