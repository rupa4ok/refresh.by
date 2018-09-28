<?php
    
    if ($_SESSION['name'] !== 'admin')
    {
        header('Location: /',true, 301); //редирект на главную
    }

    include_once ROOT. '/models/Admin.php';

class AdminController
{

    public function actionPanel()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');

        $uri = $_SERVER['REQUEST_URI'];
        $admin = new Admin();

        switch ($uri) {
            case '/admin1':
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
                require_once(ROOT . '/views/project.php');
                break;
            case '/admin6':
            default:
                echo 'Страница 404';
                break;
        }

        require_once(ROOT . '/views/footer.php');

        return true;
    }



}