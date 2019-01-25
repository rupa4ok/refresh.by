<header><img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Объекты</h1>
        </div>
        <div class="row">
            <?php
            
            $id = $_SESSION['id'];
            $table = 'object';
            $role = $_SESSION['role'];
            $result = $this->admin->GetTableById($table, $id, $role);
            
            if ($_SESSION['role'] == 'admin') {
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
                
                if (isset($error_obj)) {
                    echo $error_obj;
                }
                
                echo '<div class="addObject" style="width: 50%">
                        <form method="post">
  <div class="form-group">
    <input style="width: 70%" type="text" class="col-md-8 form-control" name="name"
     aria-describedby="emailHelp" placeholder="Название объекта">
  </div>
  <button type="submit" class="btn btn-primary" name="addobject" value="addobject">Сохранить</button>
</form>
                        
                        <div>
                        </div>
                    </div>';
                
                if ($result) {
                    echo '
                    <table class="table results1" style="margin-top: 30px;">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>Название объекта</th>' .
                        '<th>Месяц</th>' .
                        '<th>Год</th>';
                    if ($_SESSION['role'] == 'admin') {
                        echo '<th>Прораб</th>';
                    }
                    echo '<th>Статус</th>' .
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $row) {
                        $realId = $row['users_id'];
                        $table = 'users';
                        $realName = $this->admin->getProrabName($table, $realId);
                        
                        foreach ($realName as $value) {
                            $real = $value['name'];
                        }
                        
                        if ($row['status'] !== 'Сдан') {
                            echo '<tr>' .
                                '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['name'] . '</a></td>' .
                                '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['mounth'] . '</a></td>' .
                                '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['year'] . '</a></td>';
                            if ($_SESSION['role'] == 'admin') {
                                echo '<td>' . $real . '</td>';
                            }
                            echo '<td><a href="#" class="' . $class . '" data-name="status" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['status'] . '</a></td>' .
                                '<td><form method="post" >
 <input type="text" value="' . $row['id'] . '" name="id" hidden>
<input type="text" name="delete" value="delete" hidden>
<button type="submit" onclick="return proverka();"><i class="fas fa-trash-alt"></i></button></form> </td>' .
                                '<td><form method="post" >
 <input type="text" value="' . $row['id'] . '" name="id" hidden>
<input type="text" name="copy" value="copy" hidden>
<button type="submit" onclick="return proverka1();"> <i class="fas fa-copy"></i></button></form></td>' .
                                '<td><button><a href="/admin5/?month='.$row['mounth'].'&year='.$row['year'].'&id='.$row['id'].'"><i class="fas fa-long-arrow-alt-right"></i></a></button></td>' .
                                '</tr>';
                        } else {
                            echo '<tr>' .
                                '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['name'] . '</a></td>' .
                                '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['mounth'] . '</a></td>' .
                                '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['year'] . '</a></td>';
                            if ($_SESSION['role'] == 'admin') {
                                echo '<td>' . $real . '</td>';
                            }
                            echo '<td><a href="#" class="' . $class . '" data-name="status" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['status'] . '</a></td>' .
                                '<td></td>' .
                                '<td></td>' .
                                '<td><form action="' . $uri . '" method="POST"><input type="text" name="id" value="' . $row['id'] . '" hidden> <button><i class="fas fa-long-arrow-alt-right"></i></button></form></td>' .
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