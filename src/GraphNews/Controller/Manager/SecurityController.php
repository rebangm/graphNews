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

class SecurityController extends BaseController{

    public function login(Request $request, Application $app){

        return $app->render('Manager/Login/login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }

}