<?php


namespace GraphNews\CrawlerBundle\Command;


use GraphNews\CrawlerBundle\GraphNewsCrawlerBundle;
use M6Web\Bundle\DaemonBundle\Command\DaemonCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GraphNews\CrawlerBundle\Crawler;
use GraphNews\AdminBundle\Entity\Website;

class WorkerCommand extends DaemonCommand
{
    protected function configure()
    {
        $this
            ->setName('worker:start')
            ->setDescription('lancer un worker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln("update Time");
        usleep(100000);
    }


}