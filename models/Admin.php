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
            $result = R::getAll( "SELECT * FROM {$table} WHERE mounth = :mounth AND year = :year",
                [':mounth' => $_SESSION['month'], ':year' => $_SESSION['year']]
            );
            return $result;
        } else {
            $result = R::getAll( "SELECT * FROM {$table} WHERE users_id = :users_id AND mounth = :mounth AND year = :year",
                [':users_id' => $id, ':mounth' => $_SESSION['month'], ':year' => $_SESSION['year']]
            );
            return $result;
        }
    }
    
    /**
     * Получение списка юзеров
     *
     * @param $table
     * @param $id
     * @param $role
     * @return array
     */
    public function GetUserById($table, $id, $role)
    {
        if ( $role == 'admin' ) {
            $result = R::findAll( $table , ' ORDER BY fio ' );
            return $result;
        } else {
            $result = R::getAll('select DISTINCT people.fio,time.nrabotnik from time left join people on time.nrabotnik = people.id where nprorab = :id and people.id is not null ORDER BY people.fio', [':id' => $id]);
            return $result;
        }
    }
    
    public function GetObjectByMounth($id)

    {
        $result = R::loadAll('object', array($id));
        return $result;
    }
    
//    public function ObjectDelete($table, $id)
//
//    {
//        $result = R::loadAll('object', array($id));
//        return $result;
//    }
    
    /**
     * @param $table
     * @param $id
     */
    public function ObjectDelete($table, $id)
    {
        R::trash( $table, $id);
        return;
    }

    public function copyObject($table, $id)
    {
        $result = R::loadAll('object', array($id));
        return $result;
    }
    
    /**
     * Создание копии объекта
     *
     * @param $data
     * @return string
     */
    public function CreateObject($data)
    {
        $error_obj = '';

        if (isset($data['name']) !== 'Пусто') {
    
            if (!isset($data['year'])) {
                $year = date("Y");
            }
    
            if (!isset($data['mounth'])) {
                $mounth = date("m");
            }
            
            if (isset($data['year'])) {
                if ($data['year'] == 'Год') {
                    $year = date("Y");
                } else {
                    $year = $data['year'];
                }
            }
            
            if (isset($data['mounth'])) {
                if ($data['mounth'] == 'Месяц') {
                    $mounth = date("m");
                } else {
                    $mounth = $data['mounth'];
                }
            }
            
            if (isset($data['name'])) {
                $obj = R::findOne('object', 'name = ?', [$data['name']]);
                if (isset($obj)) {
                    $objName = $obj->name;
                } else {
                    $objName = 0;
                    $error_obj = 'Объект существует';
                }
            }
            
            if (isset($_POST['copy'])) {
                $object = R::dispense('object');
                $object->name = 'Копия ' . $data['newName'];
                $object->year = $year;
                $object->mounth = $mounth;
                $object->status = 'Активный';
                $object->users_id = $_SESSION['id'];
    
                R::store($object);
                
                
                
            } else {
                if ($objName !== $data['name']) {
                    $object = R::dispense('object');
                    $object->name = $data['name'];
                    $object->year = $year;
                    $object->mounth = $mounth;
                    $object->status = 'Активный';
                    $object->users_id = $_SESSION['id'];
        
                    R::store($object);
                } else {
                    $error_obj = 'Объект существует';
                }
            }
   
        }
        return $error_obj;
    }
    
    /**
     * Список пользователей текущего объекта
     *
     * @param $id
     * @return \RedBeanPHP\OODBBean
     */
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
        $peoples = $object->with('ORDER BY `fio` ASC')->sharedPeopleList;
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
        $nprorab = $options['nprorab'];
        $workcheck = R::getRow( 'SELECT * FROM time WHERE date = ?
        AND mounth = ? AND nraboti = ? AND nprorab = ?',
        [ $datecheck,$mounthcheck,$nraboticheck,$nprorab]);
        
        //если номер работы отсутствует, создаем работу на месяц
        
        if (!$workcheck) {
            $time = R::dispense('time');
            $time->date = $datecheck;
            $time->mounth = $mounthcheck;
            $time->nraboti = $nraboticheck;
            $time->nrabotnik = $nrabotnik;
            $time->nprorab = $nprorab;
            $time->timework = '0';
            R::store($time);
        }
        
        return $workcheck;
        
    }
    
    /**
     * Создание копии работ для объекта
     *
     * @param $data
     */
    public function createAdd($data)
    {
        //получаем данные о новом объекте
        $options = $this->getObjectData($data);
        foreach ($options as $value) {
            $id = $value['id'];
        }
        
        //получаем привязки старого объекта
        $object = $this->GetShared($data['id']);
        $peoples = $this->GetList($object);
        
        //создаем новую работу для объекта
        foreach ($peoples as $k => $people) {
            $id1 = $people->id;
            echo $id;
            $object = R::load('object', $id);
            $peoples = R::load('people', $id1);
    
            $object->sharedPeopleList[] = $peoples;
    
            R::store($object);
        }
    }
    
    /**
     * Получаем данные о привязанных работах и рабочих
     *
     * @param $data
     * @return array
     */
    public function getSharedData($data)
    {
        $name = 'Копия ' . $data['newName'];
        return $result = R::findAll('object', ' name = ?', [ $name ]);
    }
    
    /**
     * Получаем данные об объекьте-родителе
     *
     * @param $data
     * @return array
     */
    public function getObjectData($data)
    {
        $name = 'Копия ' . $data['newName'];
        return $result = R::findAll('object', ' name = ?', [ $name ]);
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
        $result = R::findAll('people', ' ORDER BY fio ');
        return $result;
    }
    
    public function GetUserListById()
    {
        $result = R::getAll('select fio from time full join people where nprorab = 97  ORDER BY fio');
        return $result;
    }
    
    public function GetWorkTime($id)
    {
        $result = R::getAll('select SUM(timework) from time left join object_people on time.nraboti = object_people.id where people_id = :id',[':id' => $id]);
        return $result;
    }
    
    public function FindPeople()
    {
        $list = R::findAll('people', 'id > ? ORDER BY fio', [0]);
        return $list;
    }
    
    public function getDate()
    {
//        $_SESSION['month'] = 11;
//        $_SESSION['year'] = 2018;
    }
    
    public function GetProrab($table, $role)
    {
        $result = R::findAll($table, ' role = ?', [ $role ]);
        return $result;
    }

    /**
     * @param $id
     * @return array
     */
    public function getTabelList($id,$month)
    {
        return R::getAll( "SELECT * FROM time as t LEFT JOIN people as p
        ON t.nrabotnik = p.id WHERE t.nprorab = {$id} AND t.mounth = {$month} AND t.timework != 0
        ORDER BY t.date");
    }
    
    public function getProrabName($table, $realId)
    {
        $result = R::findAll($table, ' id = ?', [ $realId ]);
        return $result;
    }
    
    public function isWeekend($t) {
        setlocale(LC_TIME, 'ru_RU.utf8');
        $date = $t. '.' .$_SESSION['month']. '.' .$_SESSION['year'];
        return strftime('%A', strtotime($date)); // Суббота
    }
    
    /**
     * получение отработанных часов в конкретный день
     *
     * @param $options
     * @return array
     */
    public function getTimeByWork($options)
    {
        return R::getRow( "SELECT * FROM time WHERE nraboti = :nraboti AND mounth = :mounth AND date = :date LIMIT 1",
            [':nraboti' => $options['nraboti'], ':mounth' => $options['mounth'], ':date' => $options['date']]
        );
    }
    
}