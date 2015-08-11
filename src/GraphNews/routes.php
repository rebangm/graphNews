<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 * Time: 17:23
 */

use Symfony\Component\HttpFoundation\Response;


$app->get('/', 'GraphNews\\Controller\\Front\\HomeController::index');
$app->get('/about', 'GraphNews\\Controller\\Front\\HomeController::about');

$app->mount('/manager', new GraphNews\Controller\Manager\ManagerControllerProvider());


$app->error(function (\Exception $e, $code) use($app) {
    $message = "";
    if($app['debug'] === true && $app['request']->query->has('debug') && $app['request']->query->get('debug') == true)
            $message = $e->getMessage();
    $templatePath = "Errors";

    if(preg_match("#/manager.*#",$app['request']->getRequestUri()))
        $templatePath = "Errors/Manager";

    $templates = array(
        $templatePath.'/'.$code.'.html.twig',
        $templatePath.'/'.substr($code, 0, 2).'x.html.twig',
        $templatePath.'/'.substr($code, 0, 1).'xx.html.twig',
        $templatePath.'/default.html.twig',
    );
    try{
        return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code,'message' => $message)), $code);
    }catch (\Exception $ex){
        $app->log($ex->getMessage(),array(),\Monolog\Logger::CRITICAL);
    }

});