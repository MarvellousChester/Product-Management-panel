<?php
namespace Cgi\Application\Core;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:16
 */

use Cgi\Application\Core\Controller;

class Route
{
    /**
     *
     */
    static function start()
    {
        //Default controller and action
        $controllerName = 'default';
        $actionName = 'Index';

        //$routes = explode('/', $_SERVER['REQUEST_URI']);
        $routes = preg_split("#/|\?#", $_SERVER['REQUEST_URI']);
        //get controller name
        if ( !empty($routes[1]) )
        {
            $controllerName = $routes[1];
        }

        // get action name
        if ( !empty($routes[2]) )
        {
            $actionName = $routes[2];
        }

        // forming full names
        //$modelName = $controllerName . 'Model';
        $controllerName = '\\Cgi\Application\Controllers\\' . ucfirst($controllerName) . 'Controller';
        $actionName = 'action' . $actionName;

        // add model file and class

//        $modelFile = $modelName .'.php';
//        $modelPath = "application/models/".$modelFile;
//        if(file_exists($modelPath))
//        {
//            include "application/models/".$modelFile;
//        }

        // creating controller
        $controller = new $controllerName;
        $action = $actionName;
        $controller->setActionName($actionName);

        if(method_exists($controller, $action))
        {
            //doing smt before calling an action
            $controller->beforeAction();
            // call an action
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}