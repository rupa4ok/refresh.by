<?php
$link = mysqli_connect(
    'localhost',  /* Хост, к которому мы подключаемся */
    'refresh_tabel',       /* Имя пользователя */
    'tabeltabeltabel',   /* Используемый пароль */
    'refresh_tabel');     /* База данных для запросов по умолчанию */

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

$column = $_POST['name'];
if ($_POST['name'] == 'timework') {
    $newValue = $_POST['timework'];
}

$id = $_POST['pk'];
$newValue = str_replace(',','.',$_POST['value']);
$sql = "UPDATE `time` SET timework = '$newValue' where id = $id";
mysqli_query($link, $sql);

