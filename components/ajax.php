<?php
$link = mysqli_connect(
'localhost',  /* Хост, к которому мы подключаемся */
'refreshk_tabel',       /* Имя пользователя */
'tabeltabeltabel',   /* Используемый пароль */
'refreshk_tabel');     /* База данных для запросов по умолчанию */
mysqli_set_charset($link, "utf8");

if (!$link) {
    printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

if (isset($_POST['name'])) {
    $column = $_POST['name'];
    if ($_POST['name'] == 'date') {
        $newValue = strtotime($_POST['value']);
    } else if ($_POST['name'] == 'address') {
        $newValue = $_POST['value']['city'] . ', ул. ' . $_POST['value']['street'] . ', дом. ' . $_POST['value']['building'];
    } else {
        $newValue = $_POST['value'];
    }
    $id = $_POST['pk'];
    $sql = "UPDATE `people` SET $column = '$newValue' where id = $id";
    mysqli_query($link, $sql);
}