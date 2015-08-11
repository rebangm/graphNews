<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 */


require_once __DIR__.'/../vendor/autoload.php';
define("ENV","dev");


require_once __DIR__.'/../src/GraphNews/app.php';
require_once __DIR__.'/../src/GraphNews/routes.php';

use Monolog\Logger;
try {
    $app->run();
}catch(\Exception $e){
    $app->log($e->getMessage(), array(), Logger::CRITICAL);
}