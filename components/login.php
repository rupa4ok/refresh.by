<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once"../config/config.php";

$data1 = $_POST; //получаем данные из массива

    $errors1 = array();
    $user = R::findOne('users','email = ?',array($data1['email']));//Проверка правильности email
    if ( $user ) {
        $hash = substr( $user->password, 0, 60 );
        if (password_verify($data1['password'], $hash)) { //Проверка правильности пароля
            //Логиним юзера
            $_SESSION['logged_user'] = $user;
            $_SESSION['name'] = $user->name;

            echo '<div style="color: green">' . 'Вы авторизованы как:' . $user->name . '</div>';
        } else {
            echo "Пароль не верен";
        }
    }
    else {
        echo "Данный пользователь не найден";
    }
