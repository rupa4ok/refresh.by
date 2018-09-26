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
        <h1>Личный кабинет</h1>
    </div>
    <div class="row">
    <div class="col-md-3">
        <h3>Меню</h3>
        <div style="color: green">Вы авторизованы как: <? echo  $_SESSION['name'] ?></div>
        <ul>
            <li><a href="/admin1">Объекты</a></li>
            <li><a href="/admin2">Прорабы</a></li>
            <li><a href="/admin3">Работники</a></li>
            <li><a href="/admin4">Сводный табель</a></li>
            <li><a href="/admin5">Управление объектами</a></li>
        </ul>
    </div>
    <div class="col-md-9 content-block">
        <h4>Объекты</h4>

        <div class="col-md-9 content-block">
        
            <?php
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
                        '<th>Суммарное время</th>' .
                        '<th>Подробный табель</th>' .
                        '</tr>' .
                        '</thead>';
                
                    while( $row = mysqli_fetch_assoc($result) ){
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $row['fio'] . '" data-url="ajax1.php" >' . $row['fio'] . '</a></td>' .
                            '<td><a href="#" class="people-editable" data-name="koef" data-type="text" data-pk="' . $row['id'] . '" data-url="ajax1.php" >' . $row['koef'] . '</a></td>' .
                            '<td><a href="#" class="people-editable" data-name="koef" data-type="text" data-pk="' . $row['id'] . '" data-url="ajax1.php" >168 часов</a></td>' .
                            '<td><button>Подробнее</button></td>' .
                            '</tr>';
                    }
                    echo '</table>';
                    mysqli_free_result($result);
                }
                mysqli_close($link);
            ?>
        </div>


    </div>
