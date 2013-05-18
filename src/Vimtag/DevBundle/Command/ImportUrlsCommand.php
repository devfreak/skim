<?php
namespace Vimtag\DevBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Vimtag\DevBundle\Entity\Url as VimtagUrl;
use Vimtag\DevBundle\Entity\UrlScore as VimtagUrlScore;
use Vimtag\DevBundle\Entity\Category as VimtagCategory;
use Vimtag\DevBundle\Entity\User as VimtagUser;

use Doctrine\Common\Collections\Criteria;


class ImportUrlsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('import:urls')
            ->setDescription('Import urls')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "";
        $internet = file_get_contents($this->getContainer()->getParameter('kernel.cache_dir').'/internet.txt');
        $music = file_get_contents($this->getContainer()->getParameter('kernel.cache_dir').'/music.txt');

        $internet_split = explode(',', $internet);
        $music_split = explode(',', $music);

        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $user = $em
        ->getRepository('VimtagDevBundle:User')
        ->find(1);

        $category = new VimtagCategory();
        $category->setViews(0);

        foreach($internet_split as $key => $value)
        {
            if($value !== '' && filter_var('http://'.$value, FILTER_VALIDATE_URL))
            {
                $url = new VimtagUrl();
                $url->setUrl($value);
                $url->setUser($user);
                $url->setCategory($category);

                // relate this product to the category
                $urlScore = new VimtagUrlScore;
                $urlScore->setCategory($category);
                $urlScore->setPercentage(100);
                $urlScore->setInterests(0);
                $urlScore->setUrl($url);

                $em->persist($category);
                $em->persist($url);
                $em->persist($urlScore);
                $em->flush();

                $output->writeln("#$key $value saved successfully\n");
            } else {
                $output->writeln("$value is shit\n");
            }
        }

        $category = new VimtagCategory();
        $category->setViews(0);

        foreach($music_split as $key => $value)
        {
            if($value !== '' && filter_var('http://'.$value, FILTER_VALIDATE_URL))
            {
                $url = new VimtagUrl();
                $url->setUrl($value);
                $url->setUser($user);
                $url->setCategory($category);

                // relate this product to the category
                $urlScore = new VimtagUrlScore;
                $urlScore->setCategory($category);
                $urlScore->setPercentage(100);
                $urlScore->setInterests(0);
                $urlScore->setUrl($url);

                $em->persist($category);
                $em->persist($url);
                $em->persist($urlScore);
                $em->flush();

                $output->writeln("#$key $value saved successfully\n");
            } else {
                $output->writeln("$value is shit\n");
            }
        }

        /*$em = $this->getContainer()->get('doctrine')->getEntityManager('default');
        $category = $em
        -> getRepository('VimtagDevBundle:Category')
        -> find(1);

        $scores = $category->getCategory();


        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("birthday", "1982-02-17"))
            ->orderBy(array("username" => "ASC"))
            ->setFirstResult(0)
            ->setMaxResults(20)
;

        $output->writeln(var_dump($scores));*/
    }
}