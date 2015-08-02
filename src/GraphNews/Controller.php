<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:34
 */

namespace GraphNews;


class Controller {

    public function __construct(){

    }

    public function error($app)
    {
      /*
        if ($app['debug'] === true && $app['request']->query->has('debug') && $app['request']->query->get('debug') == true) {
            $message = $e->getMessage();
        }

        $templates = array(
            'errors/' . $code . '.html.twig',
            'errors/' . substr($code, 0, 2) . 'x.html.twig',
            'errors/' . substr($code, 0, 1) . 'xx.html.twig',
            'errors/default.html.twig',
        );
        return new Response($app['twig']->resolveTemplate($templates)->render(array(
                    'code' => $code,
                    'message' => $message
                )), $code);
      */
    }
}