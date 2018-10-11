<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Объекты</h1>
        </div>
        <div class="row">
<?php

$id = $_SESSION['id'];
$table = 'object';
$role = $_SESSION['role'];
$result = $admin->GetTableById($table, $id, $role);

if ( $_SESSION['role'] == 'admin' ) {
    $uri = 'admin5';
    include_once ROOT . '/views/left-menu.php';
    $class = 'people-status-editable';
} else {
    $uri = 'user5';
    include_once ROOT . '/views/left-menu1.php';
    $class = '';
}

?>
            <div class="col-md-9 content-block">
            
<?php
                
 echo '<div style="width: 50%">
                        <div id="msg" class="alert hide"></div>
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td width="40%">Название объекта</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Отчетный год</td>

                                <td><a href="#" class="myeditable editable editable-click editable-empty people-year-editable" data-type="select" data-name="year" data-original-title="Выберите отчетный год">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Отчетный месяц</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty people-mounth-editable" data-type="select" data-name="mounth" data-original-title="Выберите отчетный месяц">Пусто</a></td>
                            </tr>
                            <tr>
                                <td>Статус</td>
                                <td><a href="#" class="myeditable editable editable-click editable-empty people-status-editable" data-type="select" data-name="status" data-original-title="Выберите статус объекта">Пусто</a></td>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <button id="save-btn" class="btn btn-primary">Добавить новый объект</button>
                            <button id="reset-btn" class="btn pull-right">Сбросить данные</button>
                        </div>
                    </div>';
                
                if ($result) {
                    echo '
                    <table class="table results1" style="margin-top: 30px;">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>Название объекта</th>' .
                        '<th>Месяц</th>' .
                        '<th>Год</th>' .
                        '<th>Статус</th>' .
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $row) {
                        
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['name'] . '</a></td>' .
                            '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['mounth'] . '</a></td>' .
                            '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['year'] . '</a></td>' .
                            '<td><a href="#" class="' . $class . '" data-name="status" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['status'] . '</a></td>' .
                            '<td><form method="post" class="delete">

<input type="text" value="' . $row['id'] . '" name="id" hidden>

<button type="submit" onclick="return proverka();"> Удалить</button></td></form> ' .
                            '<td><form action="' . $uri . '" method="POST"><input type="text" name="id" value="' . $row['id'] . '" hidden> <button>Перейти</button></form></td>' .
                            '</tr>';
                    }
                    echo '</table>';
                }
                
                ?>
            </div>
        </div>
    </div>
    </div>
</section>