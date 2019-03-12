<?php
if (session_id() == '') {
    session_start();
}

//настройки php
ini_set('default_charset', 'UTF-8');
mb_internal_encoding("UTF-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(ROOT . '/app/libs/rb.php');

//Доступ к бд
R::setup('mysql:host=localhost;dbname=refreshk_tabel',
    'refreshk_tabel',
    'tabeltabeltabel');
