<?php
    /**
     * Created by PhpStorm.
     * User: 12
     * Date: 23.09.2018
     * Time: 15:48
     */
    
    class Admin
    {
        
        public function GetTable($table)
        {
            $result = R::findAll($table);
            return $result;
        }
        
        public function GetObjectList()
        {
            
            $link = mysqli_connect(
                'localhost',
                'refresh',
                'refreshrefresh',
                'refresh');
            
            if (!$link) {
                printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
                exit;
            }
            
            if ($result = mysqli_query($link, 'SELECT * FROM object ORDER BY id')) {
                
                echo '
                    <table class="table results1" style="margin-top: 30px;">' .
                    '<thead>' .
                    '<tr>' .
                    '<th>Название объекта</th>' .
                    '<th>Месяц</th>' .
                    '<th>Год</th>' .
                    '<th>Дата начала</th>' .
                    '<th>Дата сдачи</th>' .
                    '<th>Статус</th>' .
                    '</tr>' .
                    '</thead>';
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>' .
                        '<td><a href="#" class="people-editable" data-name="name" data-type="text" data-title="Имя" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['name'] . '</a></td>' .
                        '<td><a href="#" class="people-mounth-editable" data-name="mounth" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['mounth'] . '</a></td>' .
                        '<td><a href="#" class="people-year-editable" data-name="year" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['year'] . '</a></td>' .
                        '<td><a href="#" class="people-start-editable" data-name="start" data-type="date" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . date('d.m.Y', $row['start']) . '</a></td>' .
                        '<td><a href="#" class="people-finish-editable" data-name="finish" data-type="date" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . date('d.m.Y', $row['finish']) . '</a></td>' .
                        '<td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="' . $row['id'] . '" data-url="components/ajax1.php" >' . $row['status'] . '</a></td>' .
                        '<td><form method="post" class="delete"><input type="text" value="' . $row['id'] . '" name="id" hidden><button type="submit" onclick="return proverka();"> Удалить</button></td></form> ' .
                        '<td><form action="admin5" method="POST"><input type="text" name="id" value="' . $row['id'] . '" hidden> <button>Перейти</button></form></td>' .
                        '</tr>';
                }
                echo '</table>';
                mysqli_free_result($result);
            }
            mysqli_close($link);
            
            return;
        }
        
        public function export_csv(
            $table,        // Имя таблицы для экспорта
            $afields,        // Массив строк - имен полей таблицы
            $filename,        // Имя CSV файла для сохранения информации
            // (путь от корня web-сервера)
            $delim = ',',        // Разделитель полей в CSV файле
            $enclosed = '"',        // Кавычки для содержимого полей
            $escaped = '\\',        // Ставится перед специальными символами
            $lineend = '\\r\\n')
        {    // Чем заканчивать строку в файле CSV
            
            $q_export =
                "SELECT " . implode(',', $afields) .
                "   INTO OUTFILE '" . $_SERVER['DOCUMENT_ROOT'] . $filename . "' " .
                "FIELDS TERMINATED BY '" . $delim . "' ENCLOSED BY '" . $enclosed . "' " .
                "    ESCAPED BY '" . $escaped . "' " .
                "LINES TERMINATED BY '" . $lineend . "' " .
                "FROM " . $table;
            
            // Если файл существует, при экспорте будет выдана ошибка
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $filename))
                unlink($_SERVER['DOCUMENT_ROOT'] . $filename);
            $mysqli = new mysqli("localhost", "refresh", "refreshrefresh", "refresh");
            /* проверка соединения */
            if ($mysqli->connect_errno) {
                printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
                exit();
            }
            echo 'Экспорт';
            return $mysqli->query($q_export);
        }
        
        public function import_csv()
        {
            $databasehost = "localhost";
            $databasename = "refresh";
            $databasetable = "sample";
            $databaseusername = "refresh";
            $databasepassword = "refreshrefresh";
            $fieldseparator = ",";
            $lineseparator = "\n";
            $csvfile = "filename.csv";
            
            if (!file_exists($csvfile)) {
                die("File not found. Make sure you specified the correct path.");
            }
            
            try {
                $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename",
                    $databaseusername, $databasepassword,
                    array(
                        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    )
                );
            } catch (PDOException $e) {
                die("database connection failed: " . $e->getMessage());
            }
            
            $affectedRows = $pdo->exec("
    LOAD DATA LOCAL INFILE " . $pdo->quote($csvfile) . " INTO TABLE `$databasetable`
      FIELDS TERMINATED BY " . $pdo->quote($fieldseparator) . "
      LINES TERMINATED BY " . $pdo->quote($lineseparator));
            
            echo "Loaded a total of $affectedRows records from this csv file.\n";
        }
        
        public function AddUserObject($id) {

            $list = R::findAll('people', 'id > ?', [1]);
            return $list;
        }
        
        
    }