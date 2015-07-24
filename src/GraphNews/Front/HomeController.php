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

class HomeController extends Controller{

    public function render(Request $request, Application $app){
       /*
       return $app['twig']->render('index.html.twig', array(
            'content' => "hello world in my new silex Application!!!"
        ));
       */
       return $app->render('index.html.twig', array(
            'welcome' => "hello world in my new silex Application!!!"
        ));
    }
}