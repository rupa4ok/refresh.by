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
                    <li><a href="file.csv">Список объектов</a></li>
                    <li><a href="file1.csv">Табличная часть объектов</a></li>
                    <li><a href="file2.csv">Количество отработанных за день</a></li>
                </ul>
            
            </div>
        </div>
    </div>
    </div>
</section>