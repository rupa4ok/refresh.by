<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.11.2018
 * Time: 10:38
 */

$_SESSION['month'] = $_POST['month'];
echo '<span class="results3">' . 'Отчетный месяц: ' . $_POST['month'] .' - ' . $_SESSION['year']
    . '<form method="post" class="refresh">
                        <input type="text" value="257" name="id" hidden="">
                        <button type="submit">Сбросить</button></form></span>';