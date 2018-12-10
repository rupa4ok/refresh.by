<?php

if ($_SESSION['role'] !== 'admin') {
    header('Location: /', true, 301); //редирект на главную если не залогинен
}

include_once ROOT . '/models/Admin.php';
include_once ROOT . '/models/Csv.php';

class AdminController
{
    
    public function actionPanel()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');
        
        $uri = $_SERVER['REQUEST_URI'];

        $admin = new Admin();
        $csv = new Csv;

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
                    $admin->CreateObject($data);
                }
                if (isset($_POST['delete'])) {
                    $table = 'object';
                    $id = $_POST['id'];
                    $admin->ObjectDelete($table, $id);
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
                    $add = $admin->CreateObject($data);
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
            case '/admin5':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                } else {
                    $id = $_SESSION['id'];
                }
                if (isset($_POST['delete'])) {
                    $table = 'object_people';
                    $id = $_POST['number'];
                    $admin->ObjectDelete($table, $id);
                    $id = $_POST['id'];
                }
                if (isset($_POST['add']) or isset($_POST['copy'])) {
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
                $objectStatus = '$class="myeditable editable inline-input"';
                require_once(ROOT . '/views/project.php');
                break;
            case '/admin6':
                require_once(ROOT . '/views/import.php');
                break;
            case '/admin7':
                require_once(ROOT . '/views/export.php');
                break;
            case '/admin9':
                require_once(ROOT . '/views/project.php');
                break;
            case '/admin12':
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