<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'src/GraphNews/app.php';


use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

$helperSet = new HelperSet(array(
    'db' => new ConnectionHelper($app['db.orm.em']->getConnection()),
    'em' => new EntityManagerHelper($app['db.orm.em'])
));

return ConsoleRunner::run($helperSet);
