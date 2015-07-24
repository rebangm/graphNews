<?php

$app['debug'] = true;
$app['monolog.level'] = 300;
var_dump($app);

require "prod.php";

return $app;