<?php
/**
 * Created by PhpStorm.
 * User: rupak
 * Date: 25.09.2018
 * Time: 19:12
 */

//настройки php
ini_set('default_charset', 'UTF-8');
mb_internal_encoding("UTF-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "test.php";

$test1 = new test();

$test = 1000;
$test1->ActionTest(500);