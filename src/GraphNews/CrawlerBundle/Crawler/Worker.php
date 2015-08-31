<?php
/**
 *
 * @author: Jean-Philippe Dépigny <jdepigny.ext@orange.com>
 * Date: 27/08/2015
 * Time: 14:17
 */

namespace GraphNews\CrawlerBundle\Crawler;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPTimeoutException;


class Worker
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


    public function run()
    {
        try {
            $this->initializeMessagingQueue();
            $channel = $this->connection->channel();
            $logger = $this->logger;
            $callback = function ($msg) use ($logger) {
                $logger->addDebug("[x] Received : " . $msg->body . "\n");
            };

            $channel->basic_consume('working_queue', '', false, true, false, false, $callback);

            while(count($channel->callbacks)) {
                $channel->wait(null,false,2);
            }

            $this->closeMessagingQueue();
        } catch (AMQPTimeoutException $e) {
            $this->logger->info("Worker has no more jobs to do");
        } catch (\Exception $e) {
            $this->logger->error($e->getCode(). " : " . $e->getMessage());
        }
    }

    protected function initializeMessagingQueue()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'graphnews', 'test');
        $channel = $this->connection->channel();
        $channel->queue_declare('working_queue', false, false, false, false);
    }

    protected function closeMessagingQueue()
    {
        $this->connection->channel()->close();
        $this->connection->close();
    }
}