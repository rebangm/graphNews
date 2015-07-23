<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 */


require_once __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();
require_once __DIR__.'/../src/graphNews/app.php';
require_once __DIR__.'/../src/graphNews/routes.php';

$app->run();