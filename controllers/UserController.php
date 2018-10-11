<?php

if ( $_SESSION['role'] !== 'user' ) {
    header('Location: /',true, 301); //редирект на главную если не залогинен
}

include_once ROOT . '/models/Admin.php';

class UserController {
    
    public function actionPage()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');
    
        $uri = $_SERVER['REQUEST_URI'];
        $admin = new Admin();

        switch ($uri) {
            case '/user1':
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
                require_once(ROOT . '/views/project.php');
                break;
            default:
                echo 'Страница 404';
                break;
        }

        require_once(ROOT . '/views/footer.php');

        return true;
    }
}
