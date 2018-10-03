<body>
<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Личный кабинет</h1>
        </div>
        <div class="row">
            <?php include_once ROOT . '/views/left-menu.php'; ?>
            <div class="col-md-9 content-block">
                <h4>Объекты</h4>
            
                <?php
            
                $id = $_POST['id'];
            
                if ($result = R::loadAll('object', array($id))) {
                
                    foreach ($result as $res) {
                        echo '<h1>' . $res->name . '</h1>';
                    }
                
                    echo '<table class="table">' .
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
                
                    foreach ($result as $res) {
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                            '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                            '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
                            '<td><a href="#" class="people-start-editable" data-name="start" data-type="date" data-pk="' . $res->id . '" data-url="ajax1.php" >' . date('d.m.Y', $res->start) . '</a></td>' .
                            '<td><a href="#" class="people-finish-editable" data-name="finish" data-type="date" data-pk="' . $res->id . '" data-url="ajax1.php" >' . date('d.m.Y', $res->finish) . '</a></td>' .
                            '<td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                            '<td><a href="#" class="people-delete-editable" data-name="delete" id="delete' . $res->id . '" data-type="select" data-pk="' . $res->id . '" >Удалить</a></td>' .
                            '<td><form action="admin3.php" method="POST"><input type="text" name="' . $res->id . '" value="' . $res->id . '" hidden> <button>Редактировать</button></form></td>' .
                            '<td><form action="admin3.php" method="POST"><input type="text" name="' . $res->id . '" value="' . $res->id . '" hidden> <button>Копировать</button></form></td>' .
                            '</tr>';
                    }
                
                    echo '</table>';
                }
            
                $list = R::findAll('people', 'id > ?', [0]);
            
                echo '
        <form method="POST" id="form3" class="dataspan">
        <select class="js-example-basic-single" id="event-list">';
                foreach ($list as $lis) {
                    echo '<option>' . $lis->fio . '</option>';
                }
                echo '</select>

        <input name="tagger-1" id="event" value="" hidden>
        <input name="tagger-2" id="event1" value="' . $id . '" hidden>
        
        <button type="submit">Добавить работника</button>
        </form>

        ';
            
                $object = R::load('object', $id);
            
                $object->sharedPeopleList;
                $peoples = $object->with('ORDER BY `fio` DESC')->sharedPeopleList;
            
                $date1 = date('Y-m-d', $object->start);
                $date2 = date('Y-m-d', $object->finish);
                $date3 = date('d-m-Y', $object->start);
                $date4 = date('d-m-Y', $object->finish);
                $day = (strtotime($date2) - strtotime($date1)) / 3600 / 24;
            
                foreach ($peoples as $people) {
                    echo '<br> <h4>' . $people->fio . '</h4>' . '<a href="#" class="people-status-editable" data-name="koef" data-type="text" data-pk="' . $people->id . '" data-url="ajax1.php" >' . $people->koef . '</a>';
                    $i = 0;
                    $date3 = date('d-m-Y', $object->start);
                    echo '<table id="user" class="table table-bordered table-striped">
                            <tbody><tr>';
                    while ($i < 10) {
                        $i++;
                    
                        echo '<td><p>' . $date3 . '</p>
                <a href="#" class="myeditable editable editable-click" id="new_username" data-type="text" data-name="name" data-original-title="Введите название объекта">Пусто</a></td>
                
                ';
                    }
                    echo '</tr>';
                    echo '</tbody>
                        </table>';
                }
            
                $time = R::dispense('time');
                $time->date = $date3;
                R::store($time);
            
                ?>
            </div>