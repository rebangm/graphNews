<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:32
 */

namespace GraphNews\Controller\Manager;


use GraphNews\Controller\BaseController;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

class ManagerController extends BaseController{

    public function test(Request $request, Application $app){

        return $app->render('Manager/index.html.twig', array(
            'welcome' => "Administration Toto"
        ));
    }

    public function index(Request $request, Application $app){
        return $app->render('Manager/index.html.twig', array(
            'welcome' => "Administration",
            'sidenavactive' => "dashboard"
        ));
    }

    public function dashboard(Request $request, Application $app){

        return $app->render('Manager/index.html.twig', array(
            'welcome' => "dashboard",
            'sidenavactive' => "dashboard"
        ));
    }

    public function crawler(Request $request, Application $app){

        return $app->render('Manager/index.html.twig', array(
            'welcome' => "crawler",
            'sidenavactive' => "crawler"
        ));
    }
}