<header>
    <img src="/template/img/logo.png"/>
</header>

<?php

if ( $_SESSION['role'] == 'admin' ) {
    $uri = 'admin5';
    include_once ROOT . '/views/top-menu.php';
    $class = 'people-status-editable';
} else {
    $uri = 'user5';
    include_once ROOT . '/views/top-menu1.php';
    $class = '';
}

?>

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
                
 echo '<div class="addObject" style="width: 50%">
                        <div id="msg" class="alert hide"></div>
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td width="30%">Название объекта</td>
                                <td width="50%"><a href="#" class="myeditable editable editable-click editable-empty" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                                <td width="20%"><button id="save-btn" class="btn btn-primary">Добавить</button></td>
                            </tr>
                            </tbody>
                        </table>
                        
                        <form method="post" id="form4">
                    <select id="year" name="year">
                        <option selected disabled>Выберете год</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2019">2020</option>
                        <option value="2019">2021</option>
                        <option value="2019">2022</option>
                    </select>
                    <select id="mounth" name="mounth">
                        <option selected disabled>Выберете месяц</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <button type="submit">Показать</button>
                </form>
                        
                        <div>
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