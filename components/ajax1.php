<?php
$link = mysqli_connect(
    'localhost',  /* Хост, к которому мы подключаемся */
    'refresh_tabel',       /* Имя пользователя */
    'tabeltabeltabel',   /* Используемый пароль */
    'refresh_tabel');     /* База данных для запросов по умолчанию */
    mysqli_set_charset($link, "utf8");

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

var_dump($_POST);

if (isset($_POST['name'])) {
    $column = $_POST['name'];
    if ($_POST['name'] == 'start' or $_POST['name'] == 'finish') {
        $newValue = strtotime($_POST['value']);
        //echo $newValue;
    } else if ($_POST['status'] == 'status') {
        //var_dump($_POST); die;
        $newValue = $_POST['status'];
    } else {
        $newValue = $_POST['value'];
    }
    $id = $_POST['pk'];
    $sql = "UPDATE `object` SET $column = '$newValue' where id = $id";
    mysqli_query($link, $sql);
}