<?php
$link = mysqli_connect(
    'localhost',  /* Хост, к которому мы подключаемся */
    'refresh_tabel',       /* Имя пользователя */
    'tabeltabeltabel',   /* Используемый пароль */
    'refresh_tabel');     /* База данных для запросов по умолчанию */

echo 'успешная отправка';

$number = $_POST['name'];
$people_id = $_POST['pk'];
$newValue = str_replace(',','.',$_POST['value']);

$sql = "UPDATE `object_people` SET koef = '$newValue' WHERE people_id = $people_id AND id = $number";
mysqli_query($link, $sql);

