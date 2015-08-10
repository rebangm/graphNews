<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:32
 */

namespace GraphNews\Controller\Front;


use GraphNews\Controller;
use GraphNews\Controller\BaseController;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

class HomeController extends BaseController{

    public function index(Request $request, Application $app){
       /*
       return $app['twig']->render('index.html.twig', array(
            'content' => "hello world in my new silex Application!!!"
        ));
       */
        //$app->log("test log", array("tut","tyii"), Logger::CRITICAL);
        //$app['monolog']->addDebug("youhou");


       return $app->render('Front/index.html.twig', array(
            'welcome' => "hello world in my new silex Application!!!",
           'nav_active' => "home"
        ));
    }

    public function about(Request $request, Application $app){


        return $app->render('Front/about.html.twig', array(
            'content' => "About us",
            'nav_active' => "about"
        ));
    }
}