<?php
use Silex\Provider\FormServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 * Time: 17:14
 */

class Config implements Silex\ServiceProviderInterface
{
    public function register(Silex\Application $app)
    {
        !defined("ROOT") AND define("ROOT", __DIR__);
        if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == "localhost"
            || getenv('SYMFONY__SHORTEN__ENV')=='development') {
            $app['debug'] = TRUE;
        }
        $app->register(new MonologServiceProvider,
            array('monolog.logfile' => ROOT . '/../temp/' . date("Y-m-d") . '.txt'));

        //$app->register(new ConsoleServiceProvider);


        $app->register(new TwigServiceProvider);
        $app->register(new FormServiceProvider);
        //$app->register(new HttpCacheServiceProvider,array('http_cache.cache_dir'=>ROOT.'/../temp/'));
        /*
        $app->register(new DoctrineServiceProvider, array(
            "db.options" => array(
                "dbname"   => getenv('SYMFONY__SHORTEN__DBNAME'),
                "host"     => getenv('SYMFONY__SHORTEN__HOST'),
                "user" => getenv('SYMFONY__SHORTEN__USER'),
                "password" => getenv('SYMFONY__SHORTEN__PASSWORD'),
//                "port"     => getenv('SYMFONY__SHORTEN__PORT'),
                "driver"   => "pdo_mysql",
            )
        ));
        */

    }
    public function boot(Silex\Application $app)
    {
            
    }
}