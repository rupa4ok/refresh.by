<?php

//@TODO: Переделать запрос к бд

$link = mysqli_connect(
    'localhost',  /* Хост, к которому мы подключаемся */
    'refresh',       /* Имя пользователя */
    'refreshrefresh',   /* Используемый пароль */
    'refresh');     /* База данных для запросов по умолчанию */

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

var_dump($_POST);

$column = $_POST['name'];
if ($_POST['name'] == 'timework') {
    $newValue = $_POST['timework'];
}

$id = $_POST['pk'];
$newValue = $_POST['value'];
$sql = "UPDATE `time` SET timework = '$newValue' where id = $id";
mysqli_query($link, $sql);