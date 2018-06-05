<?php
require_once  __DIR__ .  '/../vendor/autoload.php';





$app = new App\Application(new \Illuminate\Container\Container());
$app->run();