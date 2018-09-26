<?php
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    require_once"../config/config.php";
    
    $data = $_POST; //получаем данные из массива
    
    print_r($data);
    
    if ($data['name'] !== 'Пусто') {
        $start = $data['start'];
        $start = strtotime($start);
    
        $finish = $data['finish'];
        $finish = strtotime($finish);
    
    
        $user = R::dispense('object');
        $user->name = $data['name'];
        $user->year = $data['year'];
        $user->mounth = $data['mounth'];
        $user->start = $start;
        $user->finish = $finish;
        $user->year = $data['year'];
        $user->status = $data['status'];
    
        R::store($user);
    }
    
    




