<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.09.2018
 * Time: 11:34
 */

class Admin {
    
    public function GetTableById($table, $id, $role)
    {
        if ( $role == 'admin' ) {
            $result = R::findAll($table);
            return $result;
        } else {
            $result = R::findAll($table, ' users_id = ? ', [ $id ]);
            return $result;
        }
    }
    
    public function ObjectDelete($table, $id)
    {
        R::trash( $table, $id);
        return;
    }
    
    public function ExportCsv($table,$options)
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
        
        $fp = fopen('file.csv', 'w');
    
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
    
        fclose($fp);
        
        return;
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
    
    public function CreateObject($data)
    {
        
        if ($data['name'] !== 'Пусто') {
    
            if (!isset($data['year'])) {
                $year = date("Y");
            }
    
            if (!isset($data['mounth'])) {
                $mounth = date("Y");
            }
            
            if ($data['year']) {
                if ($data['year'] == 'Год') {
                    $year = date("Y");
                } else {
                    $year = $data['year'];
                }
            }
            
            if ($data['mounth']) {
                if ($data['mounth'] == 'Месяц') {
                    $mounth = date("m");
                } else {
                    $mounth = $data['mounth'];
                }
            }

            $object = R::dispense('object');
            $object->name = $data['name'];
            $object->year = $year;
            $object->mounth = $mounth;
            $object->status = 'Активный';
            $object->users_id = $_SESSION['id'];
        
            R::store($object);
        }
        return;
    }
    
    public function GetShared($id)
    {
        $object = R::load('object', $id);
        $object->sharedPeopleList;
        
        return $object;
    }
    
    public function GetWorkNumber($objectId, $peopleId)
    {
        $worknumber = R::getRow( 'SELECT * FROM object_people WHERE object_id = ? AND people_id = ?', [ $objectId,$peopleId ] );
        $number = $worknumber['id'];
        echo 'Номер работы: ' . $number;
        
        return $number;
    }
    
    public function GetTime()
    {
        $time = 0;
        return $time;
    }
    
    public function GetList($object)
    {
        $peoples = $object->with('ORDER BY `fio` DESC')->sharedPeopleList;
        return $peoples;
    }
    
    public function GetData()
    {
    
    }
    
}