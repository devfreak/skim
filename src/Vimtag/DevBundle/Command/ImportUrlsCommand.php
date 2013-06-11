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
ini_set('memory_limit', '10000000M');
        $text = "";
        $internet = file_get_contents($this->getContainer()->getParameter('kernel.cache_dir').'/internet.txt');
        $music = file_get_contents($this->getContainer()->getParameter('kernel.cache_dir').'/music.txt');
        $yoga = file_get_contents($this->getContainer()->getParameter('kernel.cache_dir').'/yoga.txt');

        $internet_split = explode(',', $internet);
        $music_split = explode(',', $music);
        $yoga_split = explode(',', $yoga);

        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        $user = $em
        ->getRepository('VimtagDevBundle:User')
        ->find(1);

        $category = new VimtagCategory();
        $category->setViews(0);
        $em->persist($category);
        foreach($internet_split as $key => $value)
        {
            if($value !== '' && filter_var('http://'.$value, FILTER_VALIDATE_URL))
            {
                $url = new VimtagUrl();
                $url->setUrl($value);
                $url->setUser($user);
                $url->setCategory($category);
                $url->setInterests(1);
                $url->setViews(0);

                // relate this product to the category
                $urlScore = new VimtagUrlScore;
                $urlScore->setCategory($category);
                $urlScore->setPercentage(100);
                $urlScore->setUrl($url);

                $em->persist($url);
                $em->persist($urlScore);

                unset($url);
                unset($urlScore);

                $output->writeln("#$key $value saved successfully\n");
            } else {
                $output->writeln("$value is shit\n");
            }
        }

        $category = new VimtagCategory();
        $category->setViews(0);
        $em->persist($category);
        foreach($music_split as $key => $value)
        {
            if($value !== '' && filter_var('http://'.$value, FILTER_VALIDATE_URL))
            {
                $url = new VimtagUrl();
                $url->setUrl($value);
                $url->setUser($user);
                $url->setCategory($category);
                $url->setInterests(1);
                $url->setViews(0);

                // relate this product to the category
                $urlScore = new VimtagUrlScore;
                $urlScore->setCategory($category);
                $urlScore->setPercentage(100);
                $urlScore->setUrl($url);

                $em->persist($url);
                $em->persist($urlScore);

                unset($url);
                unset($urlScore);

                $output->writeln("#$key $value saved successfully\n");
            } else {
                $output->writeln("$value is shit\n");
            }
        }

        $category = new VimtagCategory();
        $category->setViews(0);
        $em->persist($category);
        foreach($yoga_split as $key => $value)
        {
            if($value !== '' && filter_var('http://'.$value, FILTER_VALIDATE_URL))
            {
                $url = new VimtagUrl();
                $url->setUrl($value);
                $url->setUser($user);
                $url->setCategory($category);
                $url->setInterests(1);
                $url->setViews(0);

                // relate this product to the category
                $urlScore = new VimtagUrlScore;
                $urlScore->setCategory($category);
                $urlScore->setPercentage(100);
                $urlScore->setUrl($url);

                $em->persist($url);
                $em->persist($urlScore);

                unset($url);
                unset($urlScore);

                $output->writeln("#$key $value saved successfully\n");
            } else {
                $output->writeln("$value is shit\n");
            }
        }

        $em->flush();
    }
}