<?php

namespace App;

use App;
use Exception;

class InvalidRouteException extends Exception {}

class Kernel
{

    public $defaultControllerName = 'Home';

    public $defaultActionName = "index";

    public function launch()
    {
        list($controllerName, $actionName, $params) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);
    }


    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        $controllerFile = ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
        if(!file_exists($controllerFile)){
            throw new InvalidRouteException("Файл $controllerFile не найден");
        }
        require_once $controllerFile;
        if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
            throw new InvalidRouteException("Не найден класс $controllerName в файле $controllerFile");
        }
        $controllerName = "\\Controllers\\".ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)){
            throw new InvalidRouteException("Не найден метод $actionName в классе $controllerName");
        }
        return $controller->$actionName($params);
    }

}
