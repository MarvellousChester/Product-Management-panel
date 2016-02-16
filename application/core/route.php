<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:16
 */
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

        $routes = explode('/', $_SERVER['REQUEST_URI']);

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
        $modelName = $controllerName . 'Model';
        $controllerName = $controllerName . 'Controller';
        $actionName = 'action' . $actionName;

        // add model file and class

        $modelFile = $modelName .'.php';
        $modelPath = "application/models/".$modelFile;
        if(file_exists($modelPath))
        {
            include "application/models/".$modelFile;
        }

        // add controller file and class
        $controllerFile = $controllerName .'.php';
        $controllerPath = "application/controllers/".$controllerFile;
        if(file_exists($controllerPath))
        {
            include "application/controllers/".$controllerFile;
        }
        else
        {
            //redirect to the arror page
            Route::ErrorPage404();
        }

        // creating controller
        $controller = new $controllerName;
        $action = $actionName;

        if(method_exists($controller, $action))
        {
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