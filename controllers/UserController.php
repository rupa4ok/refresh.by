<?php

if ($_SESSION['role'] !== 'user') {
    header('Location:/',true, 301); //редирект на главную если не залогинен
}

include_once ROOT . '/models/Admin.php';

class UserController {
    
    /**
     * @return bool
     */
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
                    $error_obj = $admin->CreateObject($data);
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
                if (isset($_POST['delete'])) {
                    $table = 'object_people';
                    $id = $_POST['number'];
                    $admin->ObjectDelete($table, $id);
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
