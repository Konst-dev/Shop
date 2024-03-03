<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

use app\engine\Autoload;
use app\engine\Render;
use app\engine\Request;


include "../engine/Autoload.php";
include "../config/config.php";


spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();


$controllerName = $request->getControllerName() ?: 'main';
$actionName = $request->getActionName() ?: 'index';

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";


if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    echo $controllerClass . "Контроллер не существует!";
}
