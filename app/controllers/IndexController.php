<?php

namespace App\Controllers;

use App\Models\Helpers;
use App\Models\UserRole;
use App\Storage\PostStorage;
use App\Storage\SessionStorage;
use R;

/**
 * Class IndexController
 * @version 1.0.0
 */
//@TODO подключить контейнер внедрения зависимостей + шаблонизатор
class IndexController
{
    private $user;
    private $storage;
    private $session;
    private $helpers;
    private $role;
    private $view;
    
    /**
     * IndexController constructor.
     */
    public function __construct($view)
    {
        $this->view = $view;
        $this->session = new SessionStorage('user');
        $this->user = new UserRole($this->session);
        $this->storage = new PostStorage();
        $this->helpers = new Helpers();
        $this->Auth();
        $this->role = $this->user->getRole();
//        !$this->role ?: $this->helpers->redirect("/$this->role", 301);
    }
    
    /**
     * Главная страница
     *
     * @return mixed
     */
    public function actionMain()
    {
        require_once(ROOT . "/views/index.php");
        return;
    }
    
    public function Auth() //@TODO Переделать Auth в класс авторизации
    {
        if ($_POST) {
            $data = $this->storage->load();
            $errors1 = array();
            $user = R::findOne('users', 'email = ?', array($data['email']));//Проверка правильности email
            
            if ($user) {
                $hash = substr($user->password, 0, 60);
                $items = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role
                ];
                if (password_verify($data['password'], $hash)) { //Проверка правильности пароля
                    $this->session->save($items);
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
