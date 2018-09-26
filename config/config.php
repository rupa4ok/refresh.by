<?php
if(session_id() == '') {
    session_start();
}

//настройки php
ini_set('default_charset', 'UTF-8');
mb_internal_encoding("UTF-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once('/var/www/site19.websfera.by/data/www/site19.websfera.by/libs/rb.php');

//Подключение к бд
    R::setup( 'mysql:host=localhost;dbname=refresh', 'refresh', 'refreshrefresh' );



