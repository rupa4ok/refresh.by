<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.10.2018
 * Time: 12:47
 */

include_once ROOT . '/models/Csv.php';

class TabelController {
    
    public function actionList()
    {
        ini_set('display_errors', 0);
        error_reporting(E_ALL);
    
        $uri = $_SERVER['REQUEST_URI'];
        $csv = new Csv();
    
        switch ($uri) {
            case '/tabel1':
                $filename = 'file1.csv';
                $table = 'people';
                $csv->ExportCsv($table, $filename);
                $csv->DownloadCsv($filename);
                break;
            case '/tabel2':
                $filename = 'file2.csv';
                $csv->DownloadCsv($filename);
                break;
            default:
                echo 'Страница 404';
                break;
        }
    
        
        
    }
    
}