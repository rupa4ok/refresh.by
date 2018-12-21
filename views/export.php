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
                
                <ul>
                    <li><a href="tObjects.csv">Список объектов</a></li>
                    <li><a href="tRaboty.csv">Табличная часть объектов</a></li>
                    <li><a href="tChasy.csv">Количество отработанных за день</a></li>
                    <li><a href="sRabotniki.csv">Список работников</a></li>
                    <li><a href="sProraby.csv">Список прорабов</a></li>
                    <form action="/admin1" method="post">
                        <input type="text" name="block" value="true" hidden>
                        <button type="submit" class="btn btn-danger">Заблокировать редактирование</button>
                    </form>
                </ul>
            
            </div>
        </div>
    </div>
    </div>
</section>