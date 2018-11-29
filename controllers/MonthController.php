<?php

if ( $_SESSION['role'] !== 'admin' ) {
    header('Location: /',true, 301); //редирект на главную если не залогинен
}

include_once ROOT . '/models/Admin.php';

class MonthController
{
    
    public function actionPanel()
    {
        require_once(ROOT . '/config/config.php');
        require_once(ROOT . '/views/header.php');

        $admin = new Admin();
    
        require_once(ROOT . '/views/project.php');
        
        require_once(ROOT . '/views/footer.php');
        return true;
    }
}