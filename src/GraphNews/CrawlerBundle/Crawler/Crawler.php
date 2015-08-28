<?php
/**
 * 
 * @author: Jean-Philippe Dépigny <jdepigny.ext@orange.com>
 * Date: 27/08/2015
 * Time: 14:17
 */

namespace GraphNews\CrawlerBundle\Crawler;


use Cron\CronExpression;

class Crawler {

    protected $sitesList;
    protected $em;

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $em){
        $this->sitesList = array();
        $this->em = $em;
    }

    /**
     * add website in list for crawling
     * @param \GraphNews\AdminBundle\Entity\Website $website
     */
    public function addSite(\GraphNews\AdminBundle\Entity\Website $website){
        try {
            if ($this->isTimeToCrawl($website->getFrequency())) {
                $this->sitesList[$website->getId()] = $website;
            }
        }catch(\Exception $e){

        }
    }

    public function getSitesList(){
        return $this->sitesList;
    }

    /**
     * @param $frequency
     * @return bool
     */
    protected function isTimeToCrawl($frequency){
        $cron = CronExpression::factory($frequency);
        return $cron->isDue('now');
    }


    public function run(){
        foreach($this->sitesList as $site){

        }
    }
}