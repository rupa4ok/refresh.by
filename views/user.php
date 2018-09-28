
<body>

<header>
    <img src="/template/img/logo.png" />
</header>

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ul>
                    <li><a href="/logout.php">Выйти</a></li>
                    <li><a href="/view/personal.php">Личный кабинет</a></li>
                    <li><a href="">Информация о пользователе</a></li>
                    <li><a href="">Экспорт отчета</a></li>
                </ul>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <h1>Сотрудники</h1>
        </div>
        <div class="row">
            <div class="col-md-3">
                <h3>Меню</h3>
                <ul>
                    <li><a href="/admin1">Объекты</a></li>
                    <li><a href="/admin2">Прорабы</a></li>
                    <li><a href="/admin3">Работники</a></li>
                    <li><a href="/admin4">Сводный табель</a></li>
                    <li><a href="/admin5">Управление объектами</a></li>
                </ul>
            </div>
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
                    
                    $link = mysqli_connect(
                        'localhost',
                        'refresh',
                        'refreshrefresh',
                        'refresh');
                    
                    if (!$link) {
                        printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
                        exit;
                    }
                    
                    if ($result = mysqli_query($link, 'SELECT * FROM people ORDER BY id')) {
                        
                        echo '

                    <table class="table" style="margin-top: 30px;">' .
                            '<thead>' .
                            '<tr>' .
                            '<th>Имя сотрудника</th>' .
                            '<th>Коэфиициент сложности</th>' .
                            '<th>Номер работника</th>' .
                            '<th>Выполняемые работы</th>' .
                            '</tr>' .
                            '</thead>';
                        
                        while( $row = mysqli_fetch_assoc($result) ){
                            echo '<tr>' .
                                '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $row['fio'] . '" data-url="ajax1.php" >' . $row['fio'] . '</a></td>' .
                                '<td><a href="#" class="people-year-editable" data-name="koef" data-type="text" data-pk="' . $row['id'] . '" data-url="ajax1.php" >' . $row['koef'] . '</a></td>' .
                                '<td><a href="#" class="people-editable" data-name="nrabotnik" data-type="text" data-pk="' . $row['id'] . '" data-url="ajax1.php" >' . $row['nrabotnik'] . '</a></td>' .
                                '</tr>';
                        }
                        echo '</table>';
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
    </div>
</section>