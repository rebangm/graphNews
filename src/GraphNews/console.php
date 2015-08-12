<?php

set_time_limit(0);
require_once __DIR__.'/../../vendor/autoload.php';
$app = require_once "app.php";

use GraphNews\Command\UserCommand;

$application = $app['console'];

$application->add(new UserCommand());
$application->run();