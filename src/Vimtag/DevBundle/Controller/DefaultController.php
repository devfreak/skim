<?php

namespace Vimtag\DevBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

use Doctrine\Common\Collections\Criteria;

use Vimtag\DevBundle\Entity\UserScore;
use Vimtag\DevBundle\Entity\UrlScore;
use Vimtag\DevBundle\Entity\Follower as VimtagFollower;
use Vimtag\DevBundle\Entity\History as VimtagHistory;

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
        $this->getRequest()->headers->set('X-Frame-Options', 'GOFORIT');
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

        $em = $this->getDoctrine()->getManager();

        $lasturl = $em->getRepository('VimtagDevBundle:History')
                      ->getLastUrl($user);

        if($user->getIsInterested())
        {
            $lasturl->setNotInterest(0); 
        }
        else
        {
            $lasturl->setNotInterest($lasturl->getNotInterest()+1);
            if($lasturl->getNotInterest() >= $lasturl->getInterests()+9)
            {
                $em->remove($lasturl);
            }
        }

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
            ->getRandomUrlByCategory($category,$em->getRepository('VimtagDevBundle:Category'),$user);

            $nextcat = $user->getLastcat() + 1;
            $round = $user->getRound() + 1;

            $result = $em
            ->getRepository('VimtagDevBundle:Category')
            ->countAllCategories()
            ;

            if($round > 1)
            {

                if($result == $nextcat)
                    $user->setLastcat(1);
                else
                    $user->setLastcat($nextcat);

                $user->setRound(0);

            }
            else
            {
                $user->setRound($round);
            }

            $em->flush();

            $result = $url;

        }
        else
        {

            if($user->getIsInterested())
            {

                $user->setIsInterested(false);
                $userScore = $user->getScores();

                $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("user", $user))
                        ->andwhere(Criteria::expr()->eq("category", $user->getLastcat()))
                        ->setMaxResults(1)
                ;

                $result = $userScore->matching($criteria)->first();

                if(!$result == false)
                $result->setNotInterest(0);

            }
            else
            {
                $userScore = $user->getScores();

                $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("user", $user))
                        ->andwhere(Criteria::expr()->eq("category", $user->getLastcat()))
                        ->setMaxResults(1)
                ;

                $result = $userScore->matching($criteria)->first();

                if(!$result == false)
                {
                    $result->setNotInterest($result->getNotInterest()+1);

                    if($result->getNotInterest() == 4)
                    {

                        $result->setNotInterest(0);
                        $result->setPercentage($result->getPercentage()-2);

                        $userScore_count = $userScore->count()-1;
                        $factor = 2 / $userScore_count; 

                        foreach($user->getScores() as $score)
                        {
                            if($score->getId() !== $result->getId()) 
                                $score->setPercentage($score->getPercentage()+$factor);
                        }

                        if($result->getPercentage() <3)
                            $userScore->remove($result);

                        $userScore_sum = 0;
                        foreach($userScore as $score)
                        {
                            $userScore_sum += $score->getPercentage();
                        }

                        $userScore_diff = 100 - $userScore_sum;

                        $criteria = Criteria::create()
                            ->where(Criteria::expr()->eq("user", $user))
                            ->orderBy(array('percentage' => "DESC"))
                            ->setMaxResults(1)
                        ;

                        $highest = $userScore->matching($criteria)->first();
                        if($highest->getId() == $result->getId())
                        {
                            $criteria = Criteria::create()
                                ->where(Criteria::expr()->eq("user", $user))
                                ->orderBy(array('percentage' => "DESC"))
                                ->setFirstResult(1)
                                ->setMaxResults(1)
                            ;

                            $highest = $userScore->matching($criteria)->first();
                        }

                        $highest->setPercentage($highest->getPercentage() + $userScore_diff);

                    }

                }

            }

            $rand = rand(1,2);

            switch($rand)
            {

                case 1:
                    $scores = $em
                    ->getRepository('VimtagDevBundle:UserScore')
                    ->getAvailableCategories($user);

                    $list = array();
                    $sum = 0;
                    foreach($scores as $score)
                    {
                        $list[$score->getId()] = $score->getPercentage()/100;
                        $sum += $score->getPercentage()/100;
                    }

                    if($sum !== 1)
                    {
                        $factor = (1-$sum) / count($list);
                        foreach($list as $key => $value)
                        {
                            $list[$key] = $value + $factor;
                        }
                    }   

                    $rand = $this->dw_rand($list);

                    $user->setLastcat($rand);
                    
                    $score = $em
                    ->getRepository('VimtagDevBundle:UserScore')
                    ->find($rand);

                    $category = $score->getCategory();

                    $url = $em
                    ->getRepository('VimtagDevBundle:Url')
                    ->getRandomUrlByCategory($category,$em->getRepository('VimtagDevBundle:Category'),$user);

                break;

                case 2:

                    $url = $em
                    ->getRepository('VimtagDevBundle:Url')
                    ->getNewestUrlOfFollowers($user);
                    

                break;

            }

            $result = $url;
            $history = new VimtagHistory;
            $history->setUrl($result);
            $history->setUser($user);

            $em->persist($history);

            $user->setIsInterested(false);

            $em->flush();

        }

        return new JsonResponse(array(
        								'url' => $result->getUrl(),
                                        'id' => urlencode(base64_encode($result->getId()))
        							 )
        					   )
        ;

    }

    /**
     * @Route("/interested/{id}", name="interested", options={"expose"=true})
     */
    public function interestAction($id)
    {

    	$user = $this->container->get('security.context')->getToken()->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $id = base64_decode(urldecode($id));

        $em = $this->getDoctrine()->getManager();
        $url = $em->getRepository('VimtagDevBundle:Url')->find($id);

        /*****************************
         
            SUBSCRIBER

         *

         */

        $poster = $url->getUser();
        $followers = $user->getFollowers();

        $criteria = Criteria::create()
                            ->where(Criteria::expr()->eq("following", $user))
                            ->setMaxResults(1)
                        ;

        $follow = $followers->matching($criteria);

        if($follow->count() == 1)
        {

            $follow = $follow->first();

            if($follow->getType()==0)
                $follow->setType(1);
            elseif($follow->getType()==1)
                $follow->setType(2);

        }
        else
        {
            $following = new VimtagFollower;
            $following->setType(0);
            $following->setRound(0);
            $following->setFollower($user);
            $following->setFollowing($poster);
            $em->persist($following);
        }



        $user->setIsInterested(true);

        // count interest
        $url->setInterests($url->getInterests()+1);
        $user->setInterests($user->getInterests()+1);

        $text = "";

        $userScore = $user->getScores();
        $userScore_backup = $user->getScores();

        $urlScore = $url->getScores();
        $urlScore_backup = $url->getScores();

        /*
         *
         *       LOG
         *
         *******************************/

        $interests = array();
        $interests['url'] = $url->getInterests();
        $interests['user'] = $user->getInterests();

        $urlToUser = array();
        $userToUrl = array();

        if($user->getStatus() == 0)
        {
            foreach($url->getScores() as $score)
            {

                $newScore = new UserScore();
                $newScore->setPercentage($score->getPercentage());
                $newScore->setCategory($score->getCategory());
                $newScore->setUser($user);

                $userScore->add($newScore);

                $em->persist($newScore);

            }

            if($userScore->count() > 1)
            {


                if($user->getStatus() == 0)
                {
                    $user->setStatus(1);
                }
            }
        }
        else
        {

            foreach($urlScore_backup as $score)
            {

                if($score->getPercentage() >= 3)
                {

                    $urlToUser[$score->getId()]['urlscore_percentage'] = $score->getPercentage();
                    $urlToUser[$score->getId()]['urlscore_id'] = $score->getId();

                    $urlToUser[$score->getId()]['category'] = $score->getCategory()->getId();

                    $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("category", $score->getCategory()))
                        ->setMaxResults(1)
                    ;

                    $result = $userScore->matching($criteria)->first();

                    if(!$result)
                    {

                        $urlToUser[$score->getId()]['userscore_id'] = 'none';
                        $urlToUser[$score->getId()]['userscore_percentage'] = 0;

                        $new_percentage = 0 * ($user->getInterests() / ($user->getInterests() + $url->getInterests())) + $score->getPercentage() * ($url->getInterests() / ($user->getInterests() + $url->getInterests()));
                        $new_percentage2 = $score->getPercentage() * ($url->getInterests() / ($url->getInterests() + $user->getInterests())) + 0 * ($user->getInterests() / ($url->getInterests() + $user->getInterests()));
                    
                        $new_percentage = round($new_percentage, 2);
                        $new_percentage2 = round($new_percentage2, 2);

                        $newScore = new UserScore();
                        $newScore->setPercentage($new_percentage);
                        $newScore->setCategory($score->getCategory());
                        $newScore->setUser($user);

                        $userScore->add($newScore);

                        $em->persist($newScore);

                        $score->setPercentage($new_percentage2);

                        $urlToUser[$score->getId()]['result'] = $new_percentage;
                        $urlToUser[$score->getId()]['result2'] = $new_percentage2;

                    }
                    else
                    {

                        $urlToUser[$score->getId()]['userscore_id'] = $result->getId();
                        $urlToUser[$score->getId()]['userscore_percentage'] = $result->getPercentage();

                        $new_percentage = $result->getPercentage() * ($user->getInterests() / ($user->getInterests() + $url->getInterests())) + $score->getPercentage() * ($url->getInterests() / ($user->getInterests() + $url->getInterests()));
                        
                        $new_percentage = round($new_percentage, 2);

                        $urlToUser[$score->getId()]['result'] = $new_percentage;

                        $result->setPercentage($new_percentage);
                    }

                }
                else
                {
                    $userScore->remove($score);
                }

            }

            foreach($userScore_backup as $score)
            {

                if($score->getPercentage() >= 3)
                {

                    $userToUrl[$score->getId()]['userscore_percentage'] = $score->getPercentage();
                    $userToUrl[$score->getId()]['userscore_id'] = $score->getId();

                    $userToUrl[$score->getId()]['category'] = $score->getCategory()->getId();

                    $userToUrl[$score->getId()]['import'] = true;

                    $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("category", $score->getCategory()))
                        ->setMaxResults(1)
                    ;

                    $result = $urlScore->matching($criteria)->first();

                    if(!$result)
                    {

                        $userToUrl[$score->getId()]['urlscore_id'] = 'none';
                        $userToUrl[$score->getId()]['urlscore_percentage'] = 0;

                        $new_percentage = 0 * ($url->getInterests() / ($url->getInterests() + $user->getInterests())) + $score->getPercentage() * ($user->getInterests() / ($url->getInterests() + $user->getInterests()));
                        $new_percentage2 = $score->getPercentage() * ($user->getInterests() / ($user->getInterests() + $url->getInterests())) + 0 * ($url->getInterests() / ($user->getInterests() + $url->getInterests()));
                        
                        $new_percentage = round($new_percentage, 2);
                        $new_percentage2 = round($new_percentage2, 2);

                        $newScore = new UrlScore();
                        $newScore->setPercentage($new_percentage);
                        $newScore->setCategory($score->getCategory());
                        $newScore->setUrl($url);

                        $urlScore->add($newScore);

                        $em->persist($newScore);

                        $score->setPercentage($new_percentage2);

                        $userToUrl[$score->getId()]['result'] = $new_percentage;
                        $userToUrl[$score->getId()]['result2'] = $new_percentage2;

                    }
                    else
                    {

                        $userToUrl[$score->getId()]['urlscore_id'] = $result->getId();
                        $userToUrl[$score->getId()]['urlscore_percentage'] = $result->getPercentage();

                        $new_percentage = $result->getPercentage() * ($url->getInterests() / ($url->getInterests() + $user->getInterests())) + $score->getPercentage() * ($user->getInterests() / ($url->getInterests() + $user->getInterests()));
                        
                        $new_percentage = round($new_percentage, 2);

                        $userToUrl[$score->getId()]['result'] = $new_percentage;

                        $result->setPercentage($new_percentage);
                        
                    }

                }
                else
                {
                    $userScore->remove($score);
                }

            }

                    /*****************************************
                     * RUNDEN
                     */
        
            $userScore_sum = 0;
            foreach($userScore as $score)
            {
                $userScore_sum += $score->getPercentage();
            }

            $urlScore_sum = 0;
            foreach($urlScore as $score)
            {
                $urlScore_sum += $score->getPercentage();
            }

            $urlScore_diff = 100 - $userScore_sum;
            $userScore_diff = 100 - $userScore_sum;

            $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("url", $url))
                        ->orderBy(array('percentage' => "DESC"))
                        ->setMaxResults(1)
                    ;

            $result = $urlScore->matching($criteria)->first();

            $result->setPercentage($result->getPercentage() + $urlScore_diff);
            $url->setCategory($result->getCategory());

            $lastcat = $em
                     ->getRepository('VimtagDevBundle:Category')
                     ->find($user->getLastcat());

            $criteria = Criteria::create()
                        ->andwhere(Criteria::expr()->eq("user", $user))
                        ->andwhere(Criteria::expr()->eq("category", $lastcat))
                        ->setMaxResults(1)
                    ;

            $result = $userScore->matching($criteria)->first();
            if(!$result == false)
                $result->setNotInterest(0);

            $criteria = Criteria::create()
                        ->where(Criteria::expr()->eq("user", $user))
                        ->orderBy(array('percentage' => "DESC"))
                        ->setMaxResults(1)
                    ;

            $result = $userScore->matching($criteria)->first();

            $result->setPercentage($result->getPercentage() + $userScore_diff);


        }



        $em->flush();

        return new JsonResponse(array(
                                        'message' => $id,
                                        'userToUrl' => $userToUrl,
                                        'urlToUser' => $urlToUser,
                                        'interests' => $interests
                                     )
                               )
        ;



    }

    private function dw_rand ($space, $errval = false) { 
      $res = 1000000000; 
      $rn = mt_rand(0, $res - 1); 
      $psum = 0;
      foreach ($space as $element => $probability) { 
       $psum += $probability * $res; 
       if ($psum > $rn) return $element; 
      } 

      return $errval; 
     } 

}
