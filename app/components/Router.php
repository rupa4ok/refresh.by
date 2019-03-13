<?php

namespace App\Components;

use App\Controllers\IndexController;

/**
 * Class Router
 * @package App\components\Router
 */
class Router
{
    /**
     * @var mixed
     */
    private $routes;
    
    public function __construct()
    {
        $routesPath = ROOT.'/app/config/routes.php';
        $this->routes = include($routesPath);
    }

// Return type
    
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return;
    }
    
    public function run()
    {
        $uri = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $path) {
            
            if(preg_match("~$uriPattern~", $uri)) {
                $segments = explode('/', $path);
                $segments2 = explode('/', $path);
                
                $view = array_shift($segments2);
                $controllerName = array_shift($segments).'Controller';
                
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst((array_shift($segments)));
                
                $controllerFile = ROOT . '/app/controllers/' .$controllerName. '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $objectName = trim("App\Controllers" . "\ ") . $controllerName;
                
                $controllerObject = new $objectName($view);
                $result = $controllerObject->$actionName();
                
                return $view;
                if ($result != null) {
                    break;
                }
            }
            
        }
    }
}