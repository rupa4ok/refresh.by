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

                <a href="file.csv">Скачать файл</a>
                
                <?php

                ini_set('display_errors', 0);
                error_reporting(E_ALL);
                
                $table = 'people';
                $filename = 'file.csv';
                $csv->ExportCsv($table,$filename);
                
                ?>
                
            </div>
        </div>
    </div>
    </div>
</section>