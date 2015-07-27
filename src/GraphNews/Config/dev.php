<?php

$app['debug'] = true;
$app['monolog.level'] = 300;

require "prod.php";

return $app;