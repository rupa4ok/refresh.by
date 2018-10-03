<body>

<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Сотрудники</h1>
        </div>
        <div class="row">
            <?php include_once ROOT . '/views/left-menu.php'; ?>
            <div class="col-md-9 content-block">
                
                <?php
                
                echo '<div style="width: 50%">
                    <div id="msg" class="alert hide"></div>
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td width="40%">ФИО</td>
                            <td><a href="#" class="myeditable editable editable-click editable-empty" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                        </tr>
                        <tr>
                            <td>Номер работника</td>

                            <td><a href="#" class="myeditable editable editable-click editable-empty people-year-editable" data-type="select" data-name="year" data-original-title="Выберите отчетный год">Пусто</a></td>
                        </tr>
                        </tr>
                        </tbody>
                    </table>
                    <div>
                        <button id="save-btn" class="btn btn-primary">Добавить работника</button>
                        <button id="reset-btn" class="btn pull-right">Сбросить данные</button>
                    </div>
                </div>';
                
                $table = 'people';
                $role = $_SESSION['role'];
                $id = $_SESSION['id'];
                if ( $result = $admin->GetTableById($table, $id, $role)) {
                    
                    echo '

                    <table class="table" style="margin-top: 30px;">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>Имя сотрудника</th>' .
                        '<th>Номер работника</th>' .
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $row) {
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $row['fio'] . '" data-url="ajax1.php" >' . $row['fio'] . '</a></td>' .
                            '<td>' . $row['nrabotnik'] . '</td>' .
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
