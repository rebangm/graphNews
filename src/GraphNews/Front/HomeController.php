<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:32
 */

namespace GraphNews\Front;


use GraphNews\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

class HomeController extends Controller{

    public function render(Request $request, Application $app){
       /*
       return $app['twig']->render('index.html.twig', array(
            'content' => "hello world in my new silex Application!!!"
        ));
       */
        //$app->log("test log", array("tut","tyii"), Logger::CRITICAL);
        //$app['monolog']->addDebug("youhou");

       return $app->render('Front/index.html.twig', array(
            'welcome' => "hello world in my new silex Application!!!"
        ));
    }
}