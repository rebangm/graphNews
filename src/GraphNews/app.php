<?php

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Knp\Provider\ConsoleServiceProvider;

define("PROJECT_DIR", realpath(__DIR__ ."/../../"));
define("SRC_DIR", PROJECT_DIR ."/src/GraphNews");
!Defined("ENV") ? define("ENV","prod") : "" ;

$app->register(new MonologServiceProvider,
    array('monolog.logfile' => PROJECT_DIR . '/var/log/app' . date("Y-m-d") . '.log')
);

$app->register(new ConsoleServiceProvider, array(
    'console.name'              => 'MyApplication',
    'console.version'           => '1.0.0',
    'console.project_directory' => PROJECT_DIR.'/..')
);


$app->register(new TwigServiceProvider,
    array('twig.path' => array(PROJECT_DIR . '/templates'),
          'twig.options' => array(
              'debug' => true,
              'cache' => PROJECT_DIR . '/var/cache/twig',
        ))
);
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath().'/'.ltrim($asset, '/');
    }));
    return $twig;
});

$app->register(new FormServiceProvider);

//$app->register(new HttpCacheServiceProvider,array('http_cache.cache_dir'=>ROOT.'/../temp/'));

$app->register(new DoctrineServiceProvider, array(
    "db.options" => array(
        "dbname"   => "graphnews",
        "host"     => "localhost",
        "user"     => "graphnews",
        "password" => "graphnews",
//      "port"     => getenv('SYMFONY__SHORTEN__PORT'),
        "driver"   => "pdo_mysql",
    )
));


require_once SRC_DIR ."/Config/".ENV.".php";



