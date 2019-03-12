<?php
    /**
     * Created by PhpStorm.
     * UserInfo: rupak
     * Date: 23.09.2018
     * Time: 21:14
     */

use Models\Admin;

session_start();
    
require_once "../config/config.php";
require_once "../models/Users.php";

$table = 'object';
$id = $_POST['id'];
$role = $_SESSION['role'];
$admin = new Admin();
$admin->objectDelete($table, $id);

if ( $_SESSION['role'] == 'admin' ) {
    $uri = 'admin5';
} else {
    $uri = 'user5';
}

$id = $_SESSION['id'];
$result = $admin->getTableByID($table, $id, $role);

if ($result) {
    echo '
                    <table class="table results1" style="margin-top: 30px;">' .
        '<thead>' .
        '<tr>' .
        '<th>Название объекта</th>' .
        '<th>Месяц</th>' .
        '<th>Год</th>' .
        '<th>Дата начала</th>' .
        '<th>Дата сдачи</th>' .
        '<th>Статус</th>' .
        '</tr>' .
        '</thead>';
    
    foreach ($result as $row) {
        echo '<tr>' .
            '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['name'] . '</a></td>' .
            '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['mounth'] . '</a></td>' .
            '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['year'] . '</a></td>' .
            '<td><a href="#" class="people-start-editable" data-name="start" data-type="date" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . date('d.m.Y', $row['start']) . '</a></td>' .
            '<td><a href="#" class="people-finish-editable" data-name="finish" data-type="date" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . date('d.m.Y', $row['finish']) . '</a></td>' .
            '<td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['status'] . '</a></td>' .
            '<td><form method="post">

<input type="text" value="' . $row['id'] . '" name="id" hidden>

<button type="submit" onclick="return proverka();"> Удалить</button></td></form> ' .
            '<td><form action="' . $uri . '" method="POST"><input type="text" name="id" value="' . $row['id'] . '" hidden> <button>Перейти</button></form></td>' .
            '</tr>';
    }
    echo '</table>';
}