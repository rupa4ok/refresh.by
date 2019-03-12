<?php

use Models\Helpers;
use Models\UserRole;
use Storage\PostStorage;
use Storage\SessionStorage;

class IndexController
{
    private $user;
    private $storage;
    private $sessionStorage;
    private $helpers;
    
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->storage = new PostStorage();
        $this->sessionStorage = new SessionStorage('user');
        $this->user = new UserRole($this->sessionStorage);
        $this->helpers = new Helpers();
        $this->Auth();
    }
    
    public function action()
    {

//                $this->helpers->redirect('/admin1', 301); //редирект в админку админа

        return require_once(ROOT . '/views/index.php');
    }
    
    public function Auth()
    {
        if ($_POST) {
            $data = $this->storage->load();
            $errors1 = array();
            $user = R::findOne('users', 'email = ?', array($data['email']));//Проверка правильности email
            
            if ($user) {
                $hash = substr($user->password, 0, 60);
                if (password_verify($data['password'], $hash)) { //Проверка правильности пароля
                    //Логиним юзера
                    $_SESSION['user']['logged_user'] = $user;
                    $_SESSION['user']['name'] = $user->name;
                    $_SESSION['user']['role'] = $user->role;
                    $_SESSION['user']['id'] = $user->id;
                    
                    echo '<pre>';
                    print_r($_SESSION);
                    echo '</pre>';
                    return;
                } else {
                    echo "Пароль не верен";
                }
            } else {
                echo "Данный пользователь не найден";
            }
        }
    }
}