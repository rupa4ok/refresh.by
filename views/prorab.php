<body>

<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Прорабы</h1>
        </div>
        <div class="row">
            
            <?php include_once ROOT . '/views/left-menu.php'; ?>
            
            <div class="col-md-9 content-block">
                <div class="results" style="color: red"></div>
                <form method="POST" id="form">
                    <input type="text" name="login" placeholder="Ваше имя" value="<? $data = $_POST;
                    echo @$data['login']; ?>">
                    <input type="email" name="email" placeholder="Почта" value="<? echo @$data['email']; ?>">
                    <input type="password" name="password" placeholder="Пароль" value="<? echo @$data['password']; ?>">
                    <input type="password" name="password2" placeholder="Введите пароль еще раз"
                           value="<? echo @$data['password2']; ?>">
                    <button type="submit" name="do_signup">Зарегистрироваться</button>
                </form>
                
                <?php
                
                $table = 'people';
                
                if ($result = $admin->GetTable($table)) {
                    
                    echo '

                    <table class="table" style="margin-top: 30px;">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>Имя прораба</th>' .
                        '<th>Объекты</th>' .
                        '<th>Работники</th>' .
                        
                        '</tr>' .
                        '</thead>';
                    
                    foreach ($result as $res) {
                        echo '<tr>' .
                            '<td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="' . $res['fio'] . '" data-url="ajax1.php" >' . $res['fio'] . '</a></td>' .
                            '<td><a href="#" class="people-year-editable" data-name="koef" data-type="text" data-pk="' . $res['id'] . '" data-url="ajax1.php" >' . '4' . '</a></td>' .
                            '<td><a href="#" class="people-editable" data-name="nrabotnik" data-type="text" data-pk="' . $res['id'] . '" data-url="ajax1.php" >' . $res['nrabotnik'] . '</a></td>' .
                            '</tr>';
                    }
                    echo '</table>';
                }
                
                ?>
            </div>
        </div>
    </div>
    </div>
</section>
