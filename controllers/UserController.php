<?php

use Models\Admin;

class UserController {
    
    public function __construct()
    {
        if ($_SESSION['role'] !== 'user') {
            header('Location:/',true, 301); //редирект на главную если не залогинен
        }
    }
    
    public function actionPage()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');
    
        $uri = $_SERVER['REQUEST_URI'];
        $admin = new Admin();

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
            case '/user1':
                if (isset($_POST['addobject'])) {
                    $data = $_POST; //получаем данные из массива
                    $admin->createObject($data);
                }
                if (isset($_POST['delete'])) {
                    $table = 'object';
                    $id = $_POST['id'];
                    $admin->objectDelete($table, $id);
                }
                if (isset($_POST['copy'])) {
                    $table = 'object';
                    $id = $_POST['id'];
                    $result = $admin->copyObject($table, $id);
                    foreach ($result as $res) {
                        $newName = $res->name;
                    }
                    $_POST['newName'] = $newName;
                    $data = $_POST; //получаем данные из массива
                    $add = $admin->createObject($data);
                    $admin->createAdd($data);
                }
                require_once(ROOT . '/views/project-list.php');
                break;
            case '/user2':
                require_once(ROOT . '/views/user.php');
                break;
            case '/user3':
                require_once(ROOT . '/views/users-list.php');
                break;
            case '/user4':
                require_once(ROOT . '/views/users-list.php');
                break;
            case '/user5':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                } else {
                    $id = $_SESSION['id'];
                }
                if (isset($_POST['delete'])) {
                    $table = 'object_people';
                    $id = $_POST['number'];
                    $admin->objectDelete($table, $id);
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
        
                    foreach ($workCurrent as $work)
                    {
            
                        $options = [
                            'date' => $work['date'],
                            'mounth' => $work['mounth'],
                            'nraboti' => $prevId
                        ];
            
                        $res = ($admin->getTimeByWork($options)) ;
            
                        $time = R::dispense('time');
                        $time->id = $work['id'];
                        $time->date = $work['date'];
                        $time->mounth = $work['mounth'];
                        $time->nraboti = $work['nraboti'];
                        $time->nrabotnik = $work['nrabotnik'];
                        $time->nprorab = $work['nprorab'];
                        $time->timework = $res['timework'];
            
                        R::store($time);
                    }
                }
                require_once(ROOT . '/views/project.php');
                break;
            case '/user9':
                require_once(ROOT . '/views/project.php');
                break;
            case '/user11':
                require_once(ROOT . '/views/project.php');
                break;
            default:
                require_once(ROOT . '/views/project.php');
                break;
        }

        require_once(ROOT . '/views/footer.php');

        return true;
    }
}
