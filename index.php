<?php

// Общие настройки

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы

define('ROOT', dirname(__FILE__));

require_once(ROOT.'/vendor/autoload.php');

// Установка соединения с БД

require_once(ROOT.'/config/config.php');

// Вызор Router

use Components\Router;
$router = new Router();
$router->run();
