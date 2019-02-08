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
                $uri = 'admin2';
                include_once ROOT . '/views/left-menu.php';
            } else {
                $uri = 'user2';
                include_once ROOT . '/views/left-menu1.php';
            }
            ?>
            <div class="col-md-9 content-block">
                
                <div class="col-md-12 content-block">
                    
                    <?php
                    $id = $_SESSION['id'];
                    $result = $this->admin->getTabelList($id, $_SESSION['month']);
                    $dataFio = array();
                    $dataCell = array();

                    $fioPeople = array();
                    
                    foreach ($result as $k => $res) {
                        $sheluder[] = $res['date'];
                        if ([$res['fio']]) {
                            @$fioPeople[$res['fioshort']][$res['date']] += $res['timework'];
                        }
                    }
                    
                    $sheluder = array_unique($sheluder, SORT_REGULAR);
                    
                    echo '<table id="user" class="table table-bordered  table-striped results tabel">
                            <tbody><tr><td width="150px" class = "">
                                    ФИО
                            </td>';
                    
                    foreach ($sheluder as $th) {
                        $week = $this->admin->isWeekend($th);
                        if ($week == 'Суббота' || $week == 'Воскресенье') {
                            $week = 'Sun';
                        }
                        echo '<td class = "'.$week.'">
                                    ' . $th . '
                            </td>
                            ';
                    }

                    echo '<td>
                                    Сумма
                              </td>';

                    foreach ($fioPeople as $k => $tab) {
                        echo '<tr><td class = "">
                                    ' . $k . '
                            </td>
                            ';
    
                        foreach ($sheluder as $t) {
                            $i = 0;
                            $h = 0;
                            $s = 0;
                            foreach ($tab as $f => $val) {
                                $i++;
                                if ($t == $f) {
                                    $s = $val;
                                }
                            }
    
                            $week = $this->admin->isWeekend($t);
                            if ($week == 'Суббота' || $week == 'Воскресенье') {
                                $week = 'Sun';
                            }
                            
                            echo '<td class = "'.$week.'">
                                ' . $s . '
                            </td>
                            ';
                        }
                    }
                    
                    echo '</tr>';
                    echo '</tbody>  
                        </table>';
                    
                    ?>
                </div>
            </div>