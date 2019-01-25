<?php

use Models\Admin;
use Models\Csv;

class AdminController
{
    public $admin;
    public $csv;
    
    public function __construct()
    {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /', true, 301); //редирект на главную если не залогинен
        }
        $this->admin = new Admin();
        $this->csv = new Admin();
    }
    
    public function actionPanel()
    {
        
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');
        
        $uri = $_SERVER['REQUEST_URI'];

        if (!isset($_POST['month']) and !isset($_SESSION['month'])) {
            $_SESSION['month'] = date('m');
        }
        if (!isset($_POST['year']) and !isset($_SESSION['year'])) {
            $_SESSION['year'] = date('Y');
        }

        if (isset($_SESSION['month']) and isset($_POST['month'])) {
            $_SESSION['month'] = $_POST['month'];
        }

        if (isset($_SESSION['year']) and isset($_POST['year'])) {
            $_SESSION['year'] = $_POST['year'];
        }
        
        switch ($uri) {
            case '/admin1':
                if (isset($_POST['addobject'])) {
                    $data = $_POST; //получаем данные из массива
                    $this->admin->createObject($data);
                }
                if (isset($_POST['delete'])) {
                    $table = 'object';
                    $id = $_POST['id'];
                    $nworkId = $this->admin->getNworkByObject($id);
                    $this->admin->objectDelete($table, $id);
                    if ($nworkId) {
                        $this->admin->timeDelete($nworkId);
                    }
                }
                if (isset($_POST['copy'])) {
                    $table = 'object';
                    $id = $_POST['id'];
                    $result = $this->admin->copyObject($table, $id);
                    foreach ($result as $res) {
                        $newName = $res->name;
                    }
                    $_POST['newName'] = $newName;
                    $data = $_POST; //получаем данные из массива
                    $add = $this->admin->createObject($data);
                    $this->admin->createAdd($data);
                }
                if (isset($_POST['block'])) {
                    $this->csv->block();
                }

                require_once(ROOT . '/views/project-list.php');
                break;
            case '/admin2':
                require_once(ROOT . '/views/prorab.php');
                break;
            case '/admin3':
                require_once(ROOT . '/views/user.php');
                break;
            case '/admin4':
                require_once(ROOT . '/views/users-list.php');
                break;
            case '/admin6':
                require_once(ROOT . '/views/import.php');
                break;
            case '/admin7':
                $table = 'object';
                $filename = 'tObjects.csv';
                $this->csv->exportCsv($table,$filename);
                
                $table = 'object_people';
                $filename = 'tRaboty.csv';
                $this->csv->exportCsv($table,$filename);
                
                $table = 'time';
                $filename = 'tChasy.csv';
                $this->csv->exportCsv($table,$filename);
    
                $table = 'people';
                $filename = 'sRabotniki.csv';
                $this->csv->exportCsv($table,$filename);
    
                $table = 'users';
                $filename = 'sProraby.csv';
                $this->csv->exportCsv($table,$filename);
                
                require_once(ROOT . '/views/export.php');
                break;
            case '/admin9':
                require_once(ROOT . '/views/project.php');
                break;
            case '/admin12':
                require_once(ROOT . '/views/project.php');
                break;
            default:
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                } else {
                    $id = $_SESSION['id'];
                }
                if (isset($_POST['delete'])) {
                    $table = 'object_people';
                    $id = $_POST['number'];
                    $this->admin->objectDelete($table, $id);
                    $this->admin->timeDelete($id);
                    $id = $_POST['id'];
                }
                if (isset($_POST['add'])) {
                    if (isset($_POST['tagger-1'])) {
                        $fio = $_POST['tagger-1'];
                    }
                    if (isset($_POST['tagger-2'])) {
                        $id = $_POST['tagger-2'];
                    }
        
                    $peopleid = R::getRow('SELECT id FROM people WHERE fio LIKE ? LIMIT 1', [ $fio ]);
        
                    if (isset($peopleid['id'])) {
                        $id1 = $peopleid['id'];
                    } else {
                        $id1 = 94;
                    }
        
                    echo 'id пользователя' . $id1;
        
                    $object = R::load('object', $id);
                    $peoples = R::load('people', $id1);
        
                    $object->sharedPeopleList[] = $peoples;
        
                    R::store($object);
                }
                if (isset($_POST['copy'])) {
                    $this->copyObject();
                }
                $objectStatus = '$class="myeditable editable inline-input"';
                $prevPage = 12;
                $nextPage = 2;
                require_once(ROOT . '/views/project.php');
                break;
        }
        
        require_once(ROOT . '/views/footer.php');
        return true;
    }
    
    public function copyObject()
    {
        if (isset($_POST['tagger-1'])) {
            $currentId = $_POST['tagger-1'];
        }
        if (isset($_POST['tagger-2'])) {
            $id = $_POST['tagger-2'];
        }
        if (isset($_POST['prevId'])) {
            $prevId = $_POST['prevId'];
        }
    
        $workCurrent = R::findAll('time', 'nraboti = ?', [ $currentId ]);
    
        foreach ($workCurrent as $work) {
            $options = [
                'date' => $work['date'],
                'mounth' => $work['mounth'],
                'nraboti' => $prevId
            ];
        
            $res = ($this->admin->getTimeByWork($options)) ;
            $time = R::dispense('time');
            $time->id = $work['id'];
            $time->date = $work['date'];
            $time->mounth = $work['mounth'];
            $time->year = $work['year'];
            $time->nraboti = $work['nraboti'];
            $time->nrabotnik = $work['nrabotnik'];
            $time->nprorab = $work['nprorab'];
            $time->timework = $res['timework'];
        
            R::store($time);
        }
    }
    
}