<?php


class IndexController
{
    
    
    public function action()
    {
        
        require_once(ROOT . '/views/index.php');
        if (isset($_SESSION['name'])) {
            if ($_SESSION['name'] == 'admin')
            {
                header('Location: /admin1',true, 301); //редирект в админку админа
            }
            else {
        
            }
        }
        
        return true;
    }
}