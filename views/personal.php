<?php include "header.php";
    require "../config.php";
?>
    
    <body>
    <header>
        <img src="/template/img/logo.png" />
    </header>
    
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <ul>
                        <li><a href="/logout.php">Выйти</a></li>
                        <li><a href="/view/personal.php">Личный кабинет</a></li>
                        <li><a href="">Информация о пользователе</a></li>
                    </ul>
                
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <h1>Личный кабинет</h1>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h3>Меню</h3>
                    <ul>
                        <li><a href="/admin1.php">Объекты</a></li>
                        <li><a href="/admin6.php">Табель</a></li>
                        <li><a href="/admin5.php">Прорабы</a></li>
                        <li><a href="/admin4.php">Работники</a></li>
                    </ul>
                </div>
                <div class="col-md-9 content-block">
                    <h4>Персональная информация</h4>

                </div>
            </div>
        </div>
    </section>

<?php include "footer.php" ?>