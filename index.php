<?php

use App\components\Router;

ini_set('default_charset', 'UTF-8');
mb_internal_encoding("UTF-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once('vendor/autoload.php');
require_once(ROOT . '/app/config/config.php');

$router = new Router();
$view = $router->run();
