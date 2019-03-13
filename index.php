<?php

use App\components\Router;

define('ROOT', dirname(__FILE__));

require_once('vendor/autoload.php');
require_once(ROOT . '/app/config/config.php');

$router = new Router();
$view = $router->run();

