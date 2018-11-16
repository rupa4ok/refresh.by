<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.09.2018
 * Time: 11:40
 */

class Csv {
    
    public function ExportCsv($table, $filename)
    {
        
        $data = R::findAll($table);

//        foreach ($data as $a) {
//
//            foreach ($anton as $s) {
//
//                foreach ($a as $t => $key) {
//                    if($t == $s){
//                        $array1 = array();
//                        $list = array(
//                            array(array_push($array1, $key))
//                        );
//                    }
//                }
//
//                print_r($list);
//            }
//
//        }
        
        $list = array();
        
        foreach ($data as $item) {
            $list[] = array_push($list, [$item->fio,$item->fioshort,$item->nrabotnik]);
        }
        
        $fp = fopen($filename, 'w');
        
        foreach ($list as $fields) {
            fputcsv($fp, $fields);        }
        
        fclose($fp);
        
        return;
    }
    
    /**Выгрузка файла
     *
     * @param $url
     * @param $filename
     */
    
    public function DownloadCsv($url, $filename)
    {
        
        header('Content-Type: application/x-force-download');
        header('Content-Disposition: attachment; filename="file.csv');
        readfile($url);
        
    }
    
    public function ImportCsv($filename) {
        
        ini_set('auto_detect_line_endings', true);
        if(!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $data = array();
        if(($handle = fopen($filename, 'r')) !== false) {
            while(($row = fgetcsv($handle, 100, ';')) !== false) {
                
                if(!$header) {
                    if($row[0] != 'sep=') {
                        $header = $row;
                    }
                } else {
                    if (count($header) > count($row)) {
                        $difference = count($header) - count($row);
                        for ($i = 1; $i <= $difference; $i++) {
                            $row[count($row) + 1] = '';
                        }
                    }
                }
                if($row[0] != 'sep=') {
                    $data[] = $row;
                }
            }
            fclose($handle);
        }
        
        foreach ($data as $item) {
            $user = R::dispense('people');
            $user->fio = $item['2'];
            $user->fioshort = $item['1'];
            $user->nrabotnik = $item['0'];
            R::store($user);
        }
        return $data;
        
    }
}