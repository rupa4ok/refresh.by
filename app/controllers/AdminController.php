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
    private $session;
    private $user;
    private $view;
    
    public function __construct($view)
    {
        $this->view = $view;
        $this->admin = new Admin();
        $this->csv = new Csv();
        $this->session = new SessionStorage('user');
        $this->user = new UserRole($this->session);
        $this->role = $this->user->getRole();
        $this->helpers = new Helpers();
    }
    
    public function actionPanel()
    {
        $uri = $_SERVER['REQUEST_URI'];
    
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
//        $this->role ?: $this->helpers->redirect("/", 301);
        require_once(ROOT . "/views/$this->view.php");
        return;
    }
    
}