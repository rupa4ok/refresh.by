<?php

use Models\Admin;

ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    include_once "../config/config.php";
    
    $data = $_POST; //получаем данные из массива
    $admin = new Admin();
    $admin->createObject($data);
