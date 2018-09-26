<?php
    /**
     * Created by PhpStorm.
     * User: rupak
     * Date: 23.09.2018
     * Time: 21:14
     */
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    require_once"../config/config.php";
    require_once"../models/Admin.php";
    
    R::trash( 'object', $_POST['id']);
    
    $admin = new Admin();
    $admin->GetObjectList();