<?php

namespace Vimtag\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

use Doctrine\Common\Collections\Criteria;

/**
 * @Route("/dev")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Default:index.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }

    /**
     * @Route("/next", name="next", options={"expose"=true})
     * @Template()
     */
    public function nextAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine();

        if($user->getStatus() == 0)
        {

            $category = $em
            ->getRepository('VimtagDevBundle:Category')
            ->getNextCategory($user);

            $category = $em
            ->getRepository('VimtagDevBundle:Category')
            ->find($category->getId());

            $url = $em
            ->getRepository('VimtagDevBundle:Url')
            ->getRandomUrlByCategory($category);

            $nextcat = $user->getLastcat() + 1;

            $result = $em
            ->getRepository('VimtagDevBundle:Category')
            ->countAllCategories()
            ;

            exit($result);
            $user->setLastcat($user->getLastcat() + 1);
            $em->flush();


            //$urls->getQueryBuilder('u')->andWhere('u.category = :category')->setMaxResults(1)->setParameter('category', $category->getId());
    		

            $result = $url;

        }
        else
        {

        }

        return new JsonResponse(array(
        								'url' => $result->getUrl()
        							 )
        					   )
        ;

    }

    /**
     * @Route("/interested/{url_id}/{timestamp}")
     */
    public function interestAction($url_id, $timestamp)
    {

    	$user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $url = base64_encode(urlencode(unserialize($url_id)));
        
        $scores = $user->getScores();



    }
}
