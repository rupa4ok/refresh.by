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
                        '<th>Статус</th>' .
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $res) {
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                            '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                            '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
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
                $object = $admin->GetShared($id);
                $peoples = $admin->GetList($object);
                
                foreach ($peoples as $people) {
                    $peopleId = $people->id . '<br>';
                    $objectId = $object->id . '<br>';
                    
                    echo $people->fio;
                    
                    $admin->GetWorkNumber($objectId, $peopleId);
                    
                    $date3 = date('d-m-Y', $object->start);
                    echo '<table id="user" class="table table-bordered table-striped">
                            <tbody><tr>';
                    $aDates = array();
                    $newDate = '01-' . $object->mounth . '-' . $object->year;
                    
                    $oStart = new DateTime($newDate);
                    $oEnd = clone $oStart;
                    $oEnd->add(new DateInterval("P1M"));
                    
                    while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
                        $aDates[] = $oStart->format('d');
                        $oStart->add(new DateInterval("P1D"));
                    }
                    
                    foreach ($aDates as $day) {
                        $time = 0;
                        $timework = $admin->GetTime();
                        $timedata = $admin->GetData();

//                    $time = R::dispense('time');
//                    $time->date = $day;
//                    R::store($time);
                        echo '<td><p>' . $day . '</p>
                <a href="#" class="myeditable editable editable-click" id="name" data-type="text" data-pk="' . $timedata . '" data-url="components/ajax2.php" data-name="name" data-original-title="Введите количество часов" >' . $timework . '</a></td>
                
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