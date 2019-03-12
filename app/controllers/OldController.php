<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Csv;
use App\Models\Pagination;
use App\Models\UserRole;
use App\Storage\SessionStorage;
use R;

/**
 * Class AdminController
 * @version 1.0.0
 */
class AdminController1
{
    public $admin;
    public $csv;
    private $role;
    /**
     * @var SessionStorage
     */
    private $sessionStorage;
    /**
     * @var UserRole
     */
    private $user;
    
    public function __construct()
    {
//        if ($_SESSION['user']['role'] !== 'admin') {
//            header('Location: /', true, 301); //редирект на главную если не залогинен
//        }
        $this->admin = new Admin();
        $this->csv = new Csv();
        $this->sessionStorage = new SessionStorage('user');
        $this->user = new UserRole($this->sessionStorage);
        $this->role = $this->user->getRole();
    }
    
    public function actionPanel()
    {
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

                require_once(ROOT . '/views/admin.php');
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
    
                if (isset($_POST['clear'])) {
                    $idf = $this->admin->helpers->getTrashWork();
                    foreach ($idf as $k => $item) {
                        $answer = $this->admin->helpers->getRealWork($item['nraboti']);
                        if (!$answer) {
                            $this->admin->timeDelete($item['nraboti']);
                        }
                    }
                    echo 'Очищено';
                }
                
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
                $pagination = new Pagination();
                
                $delta = $pagination->delta();
                
                $month = $pagination->getMonth();
                $year = $pagination->getYear();
    
                if (isset($_GET['idx'])) {
                    $id = $_GET['idx'];
                    $_SESSION['idx'] = $_GET['idx'];
                } else {
                    $id = $_SESSION['idx'];
                }
    
                $prevPage = $pagination->getPrevPage();
                $nextPage = $pagination->getNextPage();
                $prevYear = $pagination->getPrevYear($prevPage);
                $nextYear = $pagination->getNextYear($nextPage);
                
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
        
                    $object = R::load('object', $id);
                    $peoples = R::load('people', $id1);
        
                    $object->sharedPeopleList[] = $peoples;
        
                    R::store($object);
                }
                if (isset($_POST['copy'])) {
                    $this->copyObject();
                }
                if (isset($_POST['copyDay'])) {
                    $this->admin->copyDay();
                }
                $objectStatus = '$class="myeditable editable inline-input"';
                
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