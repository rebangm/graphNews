<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:32
 */

namespace GraphNews\Manager;


use GraphNews\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

class ManagerController extends Controller{

    public function render(Request $request, Application $app){

       return $app->render('Manage/index.html.twig', array(
            'welcome' => "Administration Toto"
        ));
    }


    public function index(Request $request, Application $app){
        var_dump("TOTO");
        return $app->render('Manage/index.html.twig', array(
            'welcome' => "Administration"
        ));
    }

    public function error(Request $request, Application $app){

    }
}