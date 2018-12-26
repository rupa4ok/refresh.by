<?php
$link = mysqli_connect(
'localhost',  /* Хост, к которому мы подключаемся */
'refresh',       /* Имя пользователя */
'refreshrefresh',   /* Используемый пароль */
'refresh');     /* База данных для запросов по умолчанию */

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

print_r($_POST);

if (isset($_POST['name'])) {
    $newValue = $_POST['value'];
    $number = $_POST['name'];
    $id = $_POST['pk'];
    $sql = "UPDATE `object_people` SET koef = '$newValue' WHERE people_id = $id AND id = $number";
    mysqli_query($link, $sql);
}