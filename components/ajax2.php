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

var_dump($_POST);

