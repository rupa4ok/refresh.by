<?php
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
    
    require_once"../config/config.php";

    $fio = $_POST['tagger-1'];
    $id = $_POST['tagger-2'];

    $peopleid = R::getRow( 'SELECT id FROM people WHERE fio LIKE ? LIMIT 1', [ $fio ]);
    
    $id1 = $peopleid['id'];
    
    $object = R::load('object', $id);
    $peoples = R::load('people', $id1);
    
    $object->sharedPeopleList[] = $peoples;
    
    R::store($object);