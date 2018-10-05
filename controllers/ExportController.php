<?php

if ( $_SESSION['role'] !== 'admin' ) {
    header('Location: /',true, 301); //редирект на главную если не залогинен
}

include_once ROOT . '/models/Admin.php';

class ExportController
{

    public function actionPanel()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $admin = new Admin();
        switch ($uri) {
            case '/export':
                require_once(ROOT . '/components/export.php');
                break;
            case '/import':
            require_once(ROOT . '/config/config.php');
                    require_once(ROOT . '/views/header.php');
                    $uri = $_SERVER['REQUEST_URI'];
                    $admin = new Admin();
                require_once(ROOT . '/views/import.php');
                require_once(ROOT . '/views/footer.php');
                break;
        }

        return true;
    }


}