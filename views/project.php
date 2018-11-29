<<<<<<< HEAD
<body>
<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php';?>

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
            }?>
            
            <div class="col-md-9 content-block">
                <h4>Объекты</h4>
                
                <?php
                
                $id = $_POST['id'];

                $result = $admin->GetObjectByMounth($id);
                
                if ($result) {
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
                        switch ($uri) {
                            case '/admin5':
                                $month = $res->mounth;
                                break;
                            case '/admin10':
                                $month = $res->mounth-1;
                                break;
                            case '/admin11':
                                header('Location: /admin5', true, 301);
                                break;
                            case '/admin12':
                                $month = $res->mounth+1;
                                break;
                            case '/user5':
                                $month = $res->mounth;
                                break;
                            case '/user10':
                                $month = $res->mounth-1;
                                break;
                            case '/user11':
                                header('Location: /admin5', true, 301);
                                break;
                            case '/user12':
                                $month = $res->mounth+1;
                                break;
                            default:
                                break;
                        }
                        
                        
                        
                        echo '<tr>' .
                            '<td><a href="#" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                            '<td><a href="#" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                            '<td><a href="#" data-name="year" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->year . '</a></td>' .
                            '<td><a href="#" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                            '</tr>';
                    }
                    
                    echo '</table><br>';
                }

                $list = $admin->FindPeople();
                
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

                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin5') {
                    echo '<div class="paginator"><div><form method="post" action="/admin'.$mounthprev = ($month -1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/admin'.$mounthnext = ($month +1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }
                if ($uri == '/user5') {
                    echo '<div class="paginator"><div><form method="post" action="/user'.$mounthprev = ($month -1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/user'.$mounthnext = ($month +1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }

                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin10') {
                    echo '<div class="paginator"><div><form method="post" action="/admin'.$mounthprev = ($month -1).'"> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/admin5"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }
                if ($uri == '/user10') {
                    echo '<div class="paginator"><div><form method="post" action="/user'.$mounthprev = ($month -1).'"></form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/user5"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }
                
                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin12') {
                    echo '<div class="paginator"><div><form method="post" action="/admin5"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/admin5"><input name="id" value="'.$id.'" hidden/></form></div></div>';
                }
                if ($uri == '/user12') {
                    echo '<div class="paginator"><div><form method="post" action="/user5"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/user5"><input name="id" value="'.$id.'" hidden/></form></div></div>';
                }
                
                $object = $admin->GetShared($id);
                $peoples = $admin->GetList($object);
                
                foreach ($peoples as $people) {
                    $peopleId = $people->id;
                    $objectId = $object->id;
                    $year = $object->year;
                    
                    echo '<div class="fio">' . $people->fio . ' Номер работы: ';
                    $number = $admin->GetWorkNumber($objectId, $peopleId);
                    echo '</div>';
                    
                    echo '<table id="user" class="table table-bordered  table-striped results">
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

                        $admin->CreateWork($options);
                        $timedata = $admin->GetWorkId($options);
                        
                        $dayWeek = $day . '-' . $month . '-2018';
                        $dayWeek = strftime("%a", strtotime($dayWeek));
                        
                        echo '<td class = "' .$dayWeek. '"><p>' . $day . '</p>
                <a href="#" class="" id="name" data-type="text" data-pk="' . $timedata . '" data-url="components/ajax2.php" data-name="timework" data-original-title="Введите количество часов" >' . $admin->GetData($timedata) . '</a></td>
                
                ';
                    }
                    echo '</tr>';
                    echo '</tbody>
                        </table>';
                }

                
                ?>
=======
<body>
<header>
    <img src="/template/img/logo.png"/>
</header>

<?php

if ( $_SESSION['role'] == 'admin' ) {
    include_once ROOT . '/views/top-menu.php';
} else {
    include_once ROOT . '/views/top-menu1.php';
}

?>

<section>
    <div class="container">
        <div class="row">
            <h1>Личный кабинет</h1>
        </div>
        <div class="row">
            <?php
    
            if ( $_SESSION['role'] == 'admin' ) {
                include_once ROOT . '/views/left-menu.php';
            } else {
                include_once ROOT . '/views/left-menu1.php';
            }
    
            ?>
            <div class="col-md-9 content-block">
                <h4>Объекты</h4>
                
                <?php
                
                $id = $_POST['id'];

                $result = $admin->GetObjectByMounth($id);
                
                if ($result) {
                    
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
                        switch ($uri) {
                            case '/admin5':
                                $month = $res->mounth;
                                break;
                            case '/admin9':
                                $month = $res->mounth-1;
                                break;
                            case '/admin11':
                                $month = $res->mounth+1;
                                break;
                            case '/user5':
                                $month = $res->mounth;
                                break;
                            case '/user9':
                                $month = $res->mounth-1;
                                break;
                            case '/user11':
                                $month = $res->mounth+1;
                                break;
                        }
                        
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->name . '</a></td>' .
                            '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->mounth . '</a></td>' .
                            '<td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="' . $res->id . '" data-url="ajax1.php" >' . $res->status . '</a></td>' .
                            '<td><form method="post" action="/index.php" class="delete">

<input type="text" value="' . $res->id . '" name="id" hidden>

<button type="submit" onclick="return proverka();"> Удалить</button></td></form> ' .
                            '</tr>';
                    }
                    
                    echo '</table><br>';
                }

                $list = $admin->FindPeople();
                
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

                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/admin5') {
                    echo '<div class="paginator"><div><form method="post" action="/admin'.$mounthprev = ($month -1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/admin'.$mounthnext = ($month +1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }
                if ($uri == '/user5') {
                    echo '<div class="paginator"><div><form method="post" action="/user'.$mounthprev = ($month -1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Предыдущий месяц" /> </form></div><div class="curent">Месяц: '.$month.'</div>
                    
<div><form method="post" action="/user'.$mounthnext = ($month +1).'"><input name="id" value="'.$id.'" hidden/><input type="submit" value="Следующий месяц" /> </form></div></div>';
                }
                
                $object = $admin->GetShared($id);
                $peoples = $admin->GetList($object);
                
                foreach ($peoples as $people) {
                    $peopleId = $people->id;
                    $objectId = $object->id;
                    $year = $object->year;
                    
                    echo '<div class="fio">' . $people->fio . ' Номер работы: ';
                    $number = $admin->GetWorkNumber($objectId, $peopleId);
                    echo '</div>';
                    
                    echo '<table id="user" class="table table-bordered  table-striped results">
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

                        $admin->CreateWork($options);
                        $timedata = $admin->GetWorkId($options);
                        
                        $dayWeek = $day . '-' . $month . '-2018';
                        $dayWeek = strftime("%a", strtotime($dayWeek));
                        
                        echo '<td class = "' .$dayWeek. '"><p>' . $day . '</p>
                <a href="#" class="myeditable editable inline-input" id="name" data-type="text" data-pk="' . $timedata . '" data-url="components/ajax2.php" data-name="timework" data-original-title="Введите количество часов" >' . $admin->GetData($timedata) . '</a></td>
                
                ';
                    }
                    echo '</tr>';
                    echo '</tbody>
                        </table>';
                }
                
                ?>
>>>>>>> 2cac73942f428d4415f6c51643a92deff2df3699
            </div>