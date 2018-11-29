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

                

                $filename = 'file.csv';

                $table = 'people';
                $options = array('fio','fioshort','nrabotnik');
                $admin->ImportCsv($filename);
                
                
                ?>
            </div>
        </div>
    </div>
    </div>
</section>