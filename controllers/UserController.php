<?php

include_once ROOT. '/models/Users.php';

class UserController {
    
    public function actionPage()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');

        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/user1':
                require_once(ROOT . '/views/users-list.php');
                echo 'Страница 1-1';
                break;
            case '/user2':
                require_once(ROOT . '/views/users-list.php');
                echo 'Страница 2-1';
                break;
            case '/user3':
                require_once(ROOT . '/views/users-list.php');
                echo 'Страница 3-1';
                break;
            case '/user4':
                require_once(ROOT . '/views/users-list.php');
                echo 'Страница 4-1';
                break;
            default:
                echo 'Страница 404';
                break;
        }

        require_once(ROOT . '/views/footer.php');

        return true;
    }

    
}

