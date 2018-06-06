<?php
require_once  __DIR__ .  '/../vendor/autoload.php';

session_start();
$app = new App\Application(new \Illuminate\Container\Container());
$app->run();