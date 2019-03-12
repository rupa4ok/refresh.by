<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\Csv;
use App\Models\Helpers;
use App\Models\Pagination;
use App\Models\UserRole;
use App\Storage\SessionStorage;
use R;

/**
 * Class AdminController
 * @version 1.0.0
 */
//@TODO подключить контейнер внедрения зависимостей + шаблонизатор
class AdminController
{
    public $admin;
    public $csv;
    private $role;
    private $helpers;
    private $sessionStorage;
    private $user;
    private $view;
    
    public function __construct($view)
    {
        $this->view = $view;
        $this->admin = new Admin();
        $this->csv = new Csv();
        $this->sessionStorage = new SessionStorage('user');
        $this->user = new UserRole($this->sessionStorage);
        $this->role = $this->user->getRole();
        $this->helpers = new Helpers();
    }
    
    public function actionPanel()
    {
//        $this->role ?: $this->helpers->redirect("/", 301);
        require_once(ROOT . "/views/$this->view.php");
        return;
    }
    
}