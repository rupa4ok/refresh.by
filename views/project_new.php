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
            <?php
            if ($_SESSION['role'] == 'admin') {
                include_once ROOT . '/views/left-menu.php';
                $class = 'people-status-editable';
            } else {
                include_once ROOT . '/views/left-menu1.php';
                $class = '';
            }
            ?>
            
            <div class="col-md-9 content-block">
                <h4>Объекты1</h4>
                
                <?php
                
                $month = $_SESSION['month'];
                $curentUrl = $day[1];
                $curentMonth = $day[2];
                
                echo $curentUrl . '-';
                echo $curentMonth;
                
                $id = 303;
                $result = $admin->getObjectByMounth($id);
                $objectStatus = '$class="inline-input"';
                
                if ($result) {
                    foreach ($result as $res) {
                        echo '<h1>' . $res->name . '</h1>';
                        if ($res->status == 'Сдан' and $_SESSION['role'] == 'UserInfo') {
                            $objectStatus = 'class="inline-input"';
                        } else {
                            $objectStatus = 'class="myeditable editable inline-input"';
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
                        $realName = $admin->getProrabName($table, $realId);
                        
                        if ($_SESSION['role'] == 'admin') {
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
                
                $list = $admin->findPeople();

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
                
                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin5') {
                    echo '<div class="paginator"><div><form method="post" action="/admin' . $mounthprev = ($month - 1) . '"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button></form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/admin' . $mounthnext = ($month + 1) . '"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-right"></i></button></form></div></div>';
                }
                if ($uri == '/user5') {
                    echo '<div class="paginator"><div><form method="post" action="/user' . $mounthprev = ($month - 1) . '"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button></form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/user' . $mounthnext = ($month + 1) . '"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-right"></i></button></form></div></div>';
                }
                
                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin10') {
                    echo '<div class="paginator"><div><form method="post" action="/admin' . $mounthprev = ($month - 1) . '"> </form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/admin5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-right"></i></button></form></div></div>';
                }
                if ($uri == '/user10') {
                    echo '<div class="paginator"><div><form method="post" action="/user' . $mounthprev = ($month - 1) . '"></form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/user5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-right"></i></button></i></form></div></div>';
                }
                
                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin12') {
                    echo '<div class="paginator"><div><form method="post" action="/admin5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button> </form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/admin5"><input name="id" value="' . $id . '" hidden/></form></div></div>';
                }
                if ($uri == '/user12') {
                    echo '<div class="paginator"><div><form method="post" action="/user5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button> </form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/user5"><input name="id" value="' . $id . '" hidden/></form></div></div>';
                }

                if ($curentMonth == 11) {
                    echo '<div class="paginator"><div><form method="post" action="/admin5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button> </form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/admin5"><input name="id" value="' . $id . '" hidden/></form></div></div>';
                }
                if ($uri == '/user12') {
                    echo '<div class="paginator"><div><form method="post" action="/user5"><input name="id" value="' . $id . '" hidden/><button type="submit"><i class="fas fa-arrow-circle-left"></i></button> </form></div><div class="curent">Месяц: ' . $month . '</div>
                    
<div><form method="post" action="/user5"><input name="id" value="' . $id . '" hidden/></form></div></div>';
                }
                
                $object = $admin->getShared($id);
                $peoples = $admin->getList($object);
                
                foreach ($peoples as $people) {
                    $peopleId = $people->id;
                    $objectId = $object->id;
                    $year = $object->year;
                    
                    if (isset($people->fio)) {
                        echo '<div class="fio">' . $people->fio . '<span style="margin-left: 10px;">КТУ: </span><a href="#" class="people-editable inputType" data-name="ktu" data-type="text" data-pk="' . $people['id'] . '" data-url="components/ajax1.php" >' . $people['id'] . '</a>';
                    } else {
                        echo '<div class="fio">
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
                    
                    $number = $admin->getWorkNumber($objectId, $peopleId);
                    
                    if ($_SESSION['role'] == 'admin') {
                        echo ' Номер работы: ' . $number;
                    }
                    if ($status !== 'Сдан' and $_SESSION) {
                        echo '
<form method="post" >
<input name="tagger-1" id="event" value="" hidden>
<input name="tagger-2" id="event1" value="' . $id . '" hidden>
<input type="text" name="copy" value="copy" hidden>
<button name="copyPeople" value="copy"><i class="fas fa-copy"></i></button>
</form>
<form method="post" >
<input type="text" value="' . $id . '" name="id" hidden>
<input type="text" value="' . $number . '" name="number" hidden>
<input type="text" name="delete" value="delete" hidden>
  <button name="copyPeople" value="delete" onclick="return proverka2();"><i class="fas fa-trash-alt"></i></button>
 </form>
 ';
                    }
                    
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
                            'nraboti' => $number,
                            'nrabotnik' => $peopleId,
                            'nprorab' => $_SESSION['id']
                        );
                        
                        $admin->createWork($options);
                        $timedata = $admin->getWorkId($options);
                        $dayWeek = $day . '-' . $month . '-2018';
                        $dayWeek = strftime("%a", strtotime($dayWeek));
                        echo '<td class = "' . $dayWeek . '"><p>' . $day . '</p>
                <a style="width: 50%" href="#" ' . $objectStatus . ' id="name" data-type="text" data-pk="' . $timedata . '" data-url="components/ajax2.php" data-name="timework" data-original-title="Введите количество часов" >' . $admin->getData($timedata) . '</a></td>
                
                ';
                    }
                    echo '</tr>';
                    echo '</tbody>
                        </table>';
                }
                
                
                ?>
            </div>