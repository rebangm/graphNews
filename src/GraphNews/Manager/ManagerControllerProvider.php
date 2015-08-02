<?php
/**
 * @author : Rebangm <rebangm@gmail.com>
 * Date: 02/08/15
 * Time: 19:02
 */

namespace GraphNews\Manager;
use Silex\Application;
use Silex\ControllerProviderInterface;



class ManagerControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        /*$controllers->get('/', function (Application $app) {
            return $app->redirect('/manager');
        });*/

        $controllers->get('/', 'GraphNews\\Manager\\ManagerController::index');
        $controllers->get('/toto', 'GraphNews\\Manager\\ManagerController::render');


        return $controllers;
    }

} 