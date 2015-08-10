<?php
/**
 * @author : Rebangm <rebangm@gmail.com>
 * Date: 02/08/15
 * Time: 19:02
 */

namespace GraphNews\Front;
use Silex\Application;
use Silex\ControllerProviderInterface;



class FrontControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        /*$controllers->get('/', function (Application $app) {
            return $app->redirect('/manager');
        });*/

        $controllers->get('/', 'GraphNews\\Front\\HomeController::index');
        $controllers->get('/about', 'GraphNews\\Front\\HomeController::about');
        return $controllers;
    }

} 