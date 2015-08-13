<?php
/**
 * @author : Rebangm <rebangm@gmail.com>
 * Date: 02/08/15
 * Time: 19:02
 */

namespace GraphNews\Controller\Manager;
use Silex\Application;
use Silex\ControllerProviderInterface;



class ManagerControllerProvider implements ControllerProviderInterface
{
    protected $app;

    public function connect(Application $app)
    {

        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];
        $controllers->get('/', 'GraphNews\\Controller\\Manager\\ManagerController::index');
        $controllers->get('/crawler', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');
        $controllers->get('/dashboard', 'GraphNews\\Controller\\Manager\\ManagerController::dashboard');
        $controllers->get('/crawler', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');
        $controllers->get('/crawler/site/list', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');
        $controllers->get('/crawler/add', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');
        $controllers->put('/crawler/site', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');
        $controllers->delete('/crawler/site', 'GraphNews\\Controller\\Manager\\ManagerController::crawler');

        $controllers->get('/login', 'GraphNews\\Controller\\Manager\\SecurityController::login');


        return $controllers;
    }

} 