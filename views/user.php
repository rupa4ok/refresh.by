<body>

<header>
    <img src="/template/img/logo.png"/>
</header>

<?php

if ( $_SESSION['role'] == 'admin' ) {
    $uri = 'admin5';
    include_once ROOT . '/views/top-menu.php';
    $class = 'people-status-editable';
} else {
    $uri = 'user5';
    include_once ROOT . '/views/top-menu.php';
    $class = '';
}

?>

<section>
    <div class="container">
        <div class="row">
            <h1>Сотрудники</h1>
        </div>
            <div class="row">
            <?php

            if ( $_SESSION['role'] == 'admin' ) {
                $uri = 'admin5';
                include_once ROOT . '/views/left-menu.php';
                $class = 'people-status-editable';
            } else {
                $uri = 'user5';
                include_once ROOT . '/views/left-menu1.php';
                $class = '';
            }
            
            ?>
            <div class="col-md-9 content-block">
                
                <?php

                if ( $_SESSION['role'] == 'admin' ) {
                    $uri = 'admin5';
                    include_once ROOT . '/views/adduser.php';
                    $class = 'people-status-editable';
                }
                
                $table = 'people';
                $role = $_SESSION['role'];
                $id = $_SESSION['id'];
                $result = $admin->getUserById($table, $id, $role);

                if ( $result ) {
                    echo '

                    <table class="table" style="margin-top: 30px;">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>Имя сотрудника</th>' .
                        '<th>Номер работника</th>' .
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $row) {
                        if ($role == 'admin') {
                            echo '<tr>' .
                                '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $row['fio'] . '" data-url="ajax1.php" >' . $row['fio'] . '</a></td>' .
                                '<td>' . $row['nrabotnik'] . '</td>' .
                                '</tr>';
                        } else {
                            echo '<tr>' .
                            '<td>' . $row['fio'] . '</td>' .
                            '<td>' . $row['nrabotnik'] . '</td>' .
                            '</tr>';
                    }
                        }
                        
                    echo '</table>';
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</section>
