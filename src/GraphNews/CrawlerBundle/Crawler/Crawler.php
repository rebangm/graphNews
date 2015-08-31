<?php
/**
 *
 * @author: Jean-Philippe Dépigny <jdepigny.ext@orange.com>
 * Date: 27/08/2015
 * Time: 14:17
 */

namespace GraphNews\CrawlerBundle\Crawler;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Cron\CronExpression;

class Crawler
{

    protected $sitesList;
    protected $em;
    private $connection;

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $em, \Symfony\Bridge\Monolog\Logger $logger)
    {
        $this->sitesList = array();
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * add website in list for crawling
     * @param \GraphNews\AdminBundle\Entity\Website $website
     */
    public function addSite(\GraphNews\AdminBundle\Entity\Website $website)
    {
        try {
            if ($this->isTimeToCrawl($website->getFrequency())) {
                $this->sitesList[$website->getId()] = $website;
            }
        } catch (\Exception $e) {

        }
    }

    public function getSitesList()
    {
        return $this->sitesList;
    }

    /**
     * @param $frequency
     * @return bool
     */
    protected function isTimeToCrawl($frequency)
    {
        $cron = CronExpression::factory($frequency);
        return $cron->isDue('now');
    }


    public function run()
    {
        try {
            $this->initializeMessagingQueue();
            $channel = $this->connection->channel();
            foreach ($this->sitesList as $site) {
                $msg = new AMQPMessage($site->getName());
                $channel->basic_publish($msg, '', 'working_queue');
                $this->logger->addDebug("[x] message " . $msg->body);
            }

            $this->closeMessagingQueue();
        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
        }
    }

    protected function initializeMessagingQueue()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'graphnews', 'test','/graphnews');
        $channel = $this->connection->channel();
        $channel->queue_declare('working_queue', false, false, false, false);
    }

    protected function closeMessagingQueue()
    {
        $this->connection->channel()->close();
        $this->connection->close();
    }
}