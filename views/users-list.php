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
            if ( $_SESSION['role'] == 'admin' ) {
                $uri = 'admin2';
                include_once ROOT . '/views/left-menu.php';
            } else {
                $uri = 'user2';
                include_once ROOT . '/views/left-menu1.php';
            }
            ?>
            <div class="col-md-9 content-block">

                <div class="col-md-9 content-block">
                    
                    <?php

                    $result = $admin->GetUserList();
                    
                    
                    if ($result) {
                        
                        echo '

                    <table class="table" style="margin-top: 30px;">' .
                            '<thead>' .
                            '<tr>' .
                            '<th>Имя сотрудника</th>' .
                            '<th>Суммарное время</th>' .
                            '<th>Подробный табель</th>' .
                            '</tr>' .
                            '</thead>';

                        foreach ($result as $res) {
                            $id = $res['id'];
                            $worktime = $admin->GetWorkTime($id);
                            $worktime = $worktime['0']['SUM(timework)'];
                            $worktime = ((!$worktime) ?: $worktime = 0);
                            echo '<tr>' .
                                '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $res['fio'] . '" data-url="ajax1.php" >' . $res['fio'] . '</a></td>' .
                                '<td><a href="#" class="people-editable" data-name="koef" data-type="text" data-pk="' . $res['id'] . '" data-url="ajax1.php" >' . $worktime . ' часов</a></td>' .
                                '<td><button>Подробнее</button></td>' .
                                '</tr>';
                        }
                        echo '</table>';
                        
                    }

                    ?>
                </div>


            </div>
