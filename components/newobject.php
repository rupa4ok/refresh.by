<?php
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    include_once"../config/config.php";
    include_once"../models/Admin.php";
    
    $data = $_POST; //получаем данные из массива
    $admin = new Admin();
    $admin->CreateObject($data);
