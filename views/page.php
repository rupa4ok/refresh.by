<body>
<?php include "header.php"; ?>
<header><img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Личный кабинет</h1>
        </div>
        <div class="row">
            <?php
            if ($this->role == 'admin') {
                include_once ROOT . '/views/left-menu.php';
                $class = 'people-status-editable';
            } else {
                include_once ROOT . '/views/left-menu1.php';
                $class = '';
            }
            ?>
            
            <div class="col-md-9 content-block">
                <h4>Объекты</h4>
                
                <?php
                
                $result = $this->admin->getObjectByMounth($id);
                
                $objectStatus = '$class="inline-input"';
                
                if ($result) {
                    foreach ($result as $res) {
                        echo '<h1>' . $res->name . '</h1>';
                        if ($res->status == 'Сдан' and $_SESSION['role'] == 'UserInfo') {
                            $objectStatus = 'class="inline-input"';
                            $objectTrigger = 'true';
                        } else {
                            $objectStatus = 'class="myeditable editable inline-input"';
                            $objectTrigger = 'false';
                        }
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
                        $realId = $res['users_id'];
                        $table = 'users';
                        $realName = $this->admin->getProrabName($table, $realId);
                        
                        if ($this->role == 'admin') {
                            echo '<tr>' .
                                '<td><a href="#" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                                '<td><a href="#" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                                '<td><a href="#" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
                                '<td><a href="#" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                                '</tr>';
                        } else {
                            echo '<tr>' .
                                '<td><a href="#" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                                '<td><a href="#" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                                '<td><a href="#" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
                                '<td><a href="#" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                                '</tr>';
                        }
                        $status = $res->status;
                    }
                    
                    echo '</table><br>';
                }
                
                $list = $this->admin->findPeople();
                
                if ($status !== 'Сдан') {
                    
                    echo '
        <form method="POST">
        <select class="js-example-basic-single" id="event-list">';
                    foreach ($list as $lis) {
                        echo '<option>' . $lis->fio . '</option>';
                    }
                    echo '</select>

        <input name="tagger-1" id="event" value="" hidden>
        <input name="tagger-2" id="event1" value="' . $id . '" hidden>
        <input type="text" name="add" value="add" hidden>
        
        <button type="submit">Добавить работника</button>
        </form>

        ';
                }
                
                echo '<div class="paginator">';
                if ($prevPage - $month > -2) {
                    echo '<div><a href="/' . $this->role . '5?month='.$prevPage.'&year='.$prevYear.'&idx=' . $id . '"><i class="fas fa-arrow-circle-left"></i></a></div>';
                }
                echo '<div class="curent">Месяц: ' . $month . '</div>';
                
                if ($nextPage - $month < 2) {
                    echo '<div><a href="/' . $this->role . '5?month='.$nextPage.'&year='.$nextYear.'&idx=' . $id . '"><i class="fas fa-arrow-circle-right"></i></a></div>';
                    
                }
                echo '</div>';
                
                $prevId = '';
                
                $object = $this->admin->getShared($id);
                $peoples = $this->admin->getList($object);
                
                foreach ($peoples as $people) {
                    $peopleId = $people->id;
                    $objectId = $object->id;
                    $number = $this->admin->getWorkNumber($objectId, $peopleId);
                    $ktu = $this->admin->getKtu($number);
                    
                    if (isset($people->fio)) {
                        if ($status !== 'Сдан') {
                            echo '<div class="fio">' . $people->fio . '<span style="margin-left: 10px;">КТУ: </span><a href="#" class="people-editable inputType" data-name="' . $number . '" data-type="text" data-pk="' . $people['id'] . '" data-url="http://refreshk.pro/components/ajax3.php" >' . str_replace('.', ',', $ktu) . '</a>';
                        } else {
                            echo '<div class="fio">' . $people->fio . '<span style="margin-left: 10px;">КТУ: </span>' . str_replace('.', ',', $ktu);
                        }
                    } else {
                        echo '
                <div class="fio">
                    <form method="POST">
        <select class="js-example-basic-single" id="event-list">';
                        foreach ($list as $lis) {
                            echo '<option>' . $lis->fio . '</option>';
                        }
                        echo '</select>
        <input name="tagger-1" id="event" value="" hidden>
        <input name="tagger-2" id="event1" value="' . $id . '" hidden>
        <input type="text" name="add" value="add" hidden>
        
        <button type="submit">Добавить работника</button>
        </form>';
                    }
                    
                    if ($this->role == 'admin') {
                        echo ' Номер работы: ' . $number;
                    }
                    
                    if ($status !== 'Сдан' and $_SESSION) {
                        if ($prevId !== '') {
                            echo '
<form method="post" >
<input name="tagger-1" id="event" value="' . $number . '" hidden>
<input name="tagger-2" id="event1" value="' . $id . '" hidden>
<input type="text" value="' . $prevId . '" name="prevId" hidden>
<input type="text" name="copy" value="copy" hidden>
<button name="copyPeople" value="copy" onclick="return proverka5();"><i class="fas fa-copy"></i></button>
</form>';
                        }
                        echo '
<form method="post" >
<input type="text" value="' . $id . '" name="id" hidden>
<input type="text" value="' . $number . '" name="number" hidden>
<input type="text" name="delete" value="delete" hidden>
  <button name="copyPeople" value="delete" onclick="return proverka2();"><i class="fas fa-trash-alt"></i></button>
 </form>
 ';
                        echo '
<form method="post" >
<input type="text" value="' . $id . '" name="id" hidden>
<input type="text" value="' . $number . '" name="number" hidden>
<input type="text" name="copyDay" value="copyDay" hidden>
  <button name="copyDay" value="copyDay"">8</button>
 </form>
 ';
                    }
                    $prevId = $number;
                    
                    echo '</div><table id="user" class="table table-bordered  table-striped results tableObject">
                            <tbody><tr>';
                    $aDates = array();
                    $newDate = '01-' . $month . '-' . $year;
                    $oStart = new DateTime($newDate);
                    $oEnd = clone $oStart;
                    $oEnd->add(new DateInterval("P1M"));
                    
                    while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
                        $aDates[] = $oStart->format('d');
                        $oStart->add(new DateInterval("P1D"));
                    }
                    
                    foreach ($aDates as $day) {
                        $time = 0;
                        $workstart = $object->mounth;
                        
                        $uri = $_SERVER['REQUEST_URI'];
                        
                        $options = array(
                            'day' => $day,
                            'mounth' => $month,
                            'year' => $year,
                            'nraboti' => $number,
                            'nrabotnik' => $peopleId,
                            'nprorab' => $this->user->getId()
                        );
                        
                        $this->admin->createWork($options);
                        $timedata = $this->admin->getWorkId($options);
                        $dayWeek = $this->admin->helpers->dayColor('vyhodnye', $day);
                        
                        if ($this->role == 'user' and ($objectTrigger) == 'true') {
                            echo '<td class = "' . $dayWeek . '"><p>' . $day . '</p>
                ' . str_replace('.', ',', $this->admin->getData($timedata)) . '</td>';
                        } else {
                            echo '<td class = "' . $dayWeek . '"><p>' . $day . '</p>
                <a style="width: 50%" href="http://refreshk.pro/admin5/#" ' . $objectStatus . ' id="name" data-type="text" data-pk="' . $timedata . '" data-url="http://refreshk.pro/components/ajax2.php" data-name="timework" data-original-title="Введите количество часов" >' . str_replace('.', ',', $this->admin->getData($timedata)) . '</a></td>
                
                ';
                        }
                    }
                    echo '</tr>';
                    echo '</tbody>
                        </table>';
                }
                ?>
            </div>

<?php include "footer.php" ?>