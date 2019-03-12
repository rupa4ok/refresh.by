<?php

//Подключение к бд
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "../config/config.php";
    
    $success = false;
    
    $data = $_POST; //получаем данные из массива
    
        //Проверка заполненности полей
        $errors = array();
        if ( trim($data['login'] == '' )) {
            $errors[] = 'Введите логин';
        }
        if ( trim($data['email'] == '' )) {
            $errors[] = 'Введите email';
        }
        if ( trim($data['password'] == '' )) {
            $errors[] = 'Введите пароль';
        }
        if ( trim($data['password2'] == '' )) {
            $errors[] = 'Введите повторный пароль';
        }
        if ( trim($data['password'] != $data['password2'] )) {
            $errors[] = 'Пароли не совпадают';
        }
        if ( R::count('users','email = ?', array($data['email'])) > 0) {
            $errors[] = 'Данный пользователь уже существует';
        }
        if ( empty($errors) ) { //Если ошибок в полях нет, регистрируем пользователя
            $user = R::dispense('users');
            $user->name = $data['login'];
            $user->email = $data['email'];
            $user->role = 'UserInfo';
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
            R::store($user);
            $success = $data['login'];
            echo '<div style="color: green">Вы успешно зарегистрированы</div>';
        } else {
            echo array_shift($errors);
    }
    $login = $data['login'];