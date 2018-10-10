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
    
    public function GetObjectByMounth($id)

    {
        $result = R::loadAll('object', array($id));
        return $result;
    }
    
    public function ObjectDelete($table, $id)

    {
        $result = R::loadAll('object', array($id));
        return $result;
    }
    
    public function ObjectDelete($table, $id)
    {
        R::trash( $table, $id);
        return;
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
        echo $number;
        
        return $number;
    }
    
    public function GetTime()
    {
        $time = 0;
        return $time;
    }
    
    public function GetList($object)
    {
        //ищем работников, закрепленных за данным объектом
        $peoples = $object->with('ORDER BY `fio` DESC')->sharedPeopleList;
        return $peoples;
    }
    
    public function GetData($timedata)
    {
        $worked = R::findOne( 'time', ' id = ? ', [ $timedata ] );
        return $worked->timework;
    }
    
    public function CreateWork($options)
    {
        
        //проверяем есть ли данная работа в базе данных
        //@TODO: Проверка наличия работы при каждой загрузке страницы, проверять только при создании работы
        $datecheck = $options['day'];
        $mounthcheck = $options['mounth'];
        $nraboticheck = $options['nraboti'];
        $nrabotnik = $options['nrabotnik'];
        $workcheck = R::getRow( 'SELECT * FROM time WHERE date = ? AND mounth = ? AND nraboti = ?', [ $datecheck,$mounthcheck,$nraboticheck]);
        
        //если номер работы отсутствует, создаем работу на месяц
        
        if (!$workcheck) {
            $time = R::dispense('time');
            $time->date = $datecheck;
            $time->mounth = $mounthcheck;
            $time->nraboti = $nraboticheck;
            $time->nrabotnik = $nrabotnik;
            $time->timework = '0';
            R::store($time);
        }
        
        return $workcheck;
        
    }
    
    public function GetWorkId ($options)
    {
        
        $datecheck = $options['day'];
        $mounthcheck = $options['mounth'];
        $nraboticheck = $options['nraboti'];
        $workid  = R::findOne( 'time', ' date = ? AND mounth = ? AND nraboti = ? ', [ $datecheck,$mounthcheck,$nraboticheck ] );
        return $workid->id;
        
    }
    
    public function GetUserList()
    {
        $result = R::findAll('people', ' ORDER BY id ');
        return $result;
    }
    
    public function GetWorkTime($id)
    {
        $result = R::getAll('select SUM(timework) from time left join object_people on time.nraboti = object_people.id where people_id = :id',[':id' => $id]);
        
        return $result;
    }
    
}