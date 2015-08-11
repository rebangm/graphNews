<?php

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use SilexGuzzle\GuzzleServiceProvider;

$app = new  GraphNews\GraphNewsApplication();

define("PROJECT_DIR", realpath(__DIR__ . "/../../"));
define("SRC_DIR", PROJECT_DIR . "/src/GraphNews");
!Defined("ENV") ? define("ENV", "prod") : "";

$app->register(new MonologServiceProvider, array(
        'monolog.logfile' => PROJECT_DIR . '/var/log/app' . date("Y-m-d") . '.log')
);

$app->register(new ConsoleServiceProvider, array(
        'console.name' => 'MyApplication',
        'console.version' => '1.0.0',
        'console.project_directory' => PROJECT_DIR . '/..')
);

$app->register(new GuzzleServiceProvider(), array(
        'guzzle.timeout' => 2)
);


$app->register(new TwigServiceProvider, array(
        'twig.path' => array(SRC_DIR . '/View'),
        'twig.options' => array(
            'debug' => true,
            'cache' => PROJECT_DIR . '/var/cache/twig',
        ))
);
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath() . '/' . ltrim($asset, '/');
    }));
    return $twig;
});

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new DoctrineServiceProvider, array(
    "db.options" => array(
        "dbname" => "graphnews",
        "host" => "localhost",
        "user" => "graphnews",
        "password" => "graphnews",
        "driver" => "pdo_mysql",
    )
));

$app->register(new ORM\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.class_path'            => PROJECT_DIR.'/vendor/doctrine/orm/lib',
    'db.orm.proxies_dir'           => PROJECT_DIR.'/var/cache/doctrine/Proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',
        'path'      => SRC_DIR.'/Entity',
        'namespace' => 'GraphNews\Entity',
    )),
));

$app->register(new FormServiceProvider);

$app->register(new Silex\Provider\SessionServiceProvider());

//$app->register(new HttpCacheServiceProvider,array('http_cache.cache_dir'=>ROOT.'/../temp/'));

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.encoders' => array(
        'GraphNews\Entity\User' => 'sha512'
    ),

    'security.firewalls' => array(
        'login' => array(
            'pattern' => '^/manager/login$',
            'anonymous' => true,
        ),
        'secured_area' => array(
            'pattern' => '^/manager',
            'form' => array('login_path' => '/manager/login', 'check_path' => '/manager/login_check'),
            'logout' => array('logout_path' => '/manager/logout', 'invalidate_session' => true),
            'users' => $app->share(function() use ($app) {
                        $em = $app['db.orm.em'];
                        return $em->getRepository('GraphNews\Entity\User');
                    }
                // raw password is foo
                // array(
                //'admin' => array('ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='),
            ),
        ),
    )
));





require_once SRC_DIR . "/Config/" . ENV . ".php";

return $app;

