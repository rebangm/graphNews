<?php


namespace GraphNews\CrawlerBundle\Command;


use GraphNews\CrawlerBundle\GraphNewsCrawlerBundle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GraphNews\CrawlerBundle\Crawler;
use GraphNews\AdminBundle\Entity\Website;

class CrawlerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('crawler:crawl')
            ->setDescription('lancer le crawler')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$name = $input->getArgument('name');
        //$kernel = $this->getContainer()->get('kernel');
        $em = $this->getContainer()->get('doctrine');
        $websites = $em->getRepository('GraphNewsAdminBundle:Website')->findAll();

        $crawler = new Crawler\Crawler($em, $this->getContainer()->get('logger_console'));
        foreach($websites as $website) {
            $crawler->addSite($website);
        }

        $crawler->run();


        $output->writeln("Youhou");
    }


}