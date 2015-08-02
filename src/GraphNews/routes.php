<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 * Time: 17:23
 */

use GraphNews\Front;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', 'GraphNews\\Front\\HomeController::render');

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->mount('/manager', new GraphNews\Manager\ManagerControllerProvider());

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->error(function (\Exception $e, $code) use($app) {
    if($app['debug'] === true && $app['request']->query->has('debug') && $app['request']->query->get('debug') == true)
            $message = $e->getMessage();

    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code,'message' =>$message)), $code);
});