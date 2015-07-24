<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 */


require_once __DIR__.'/../vendor/autoload.php';
define("ENV","dev");

$app = new  GraphNews\GraphNewsApplication();
require_once __DIR__.'/../src/GraphNews/app.php';
require_once __DIR__.'/../src/GraphNews/routes.php';

$app->run();