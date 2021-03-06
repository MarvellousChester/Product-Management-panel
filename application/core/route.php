<?php
namespace Cgi\Application\Core;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:16
 */

use Cgi\Application\Controllers\defaultController;

class Route
{
    /**Main router of the application
     *
     */
    static function start()
    {
        //Default controller and action
        $controllerName = 'default';
        $actionName = 'Index';

        $routes = preg_split("#/|\?#", $_SERVER['REQUEST_URI']);
        //get controller name
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        // get action name
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        // forming full names
        $controllerName = '\\Cgi\Application\Controllers\\' . ucfirst(
                $controllerName
            ) . 'Controller';
        $actionName = 'action' . $actionName;
        if (!class_exists($controllerName)) {
            Route::ErrorPage404();
        } else {
            // creating controller
            $controller = new $controllerName;
            $action = $actionName;
            $controller->setActionName($actionName);

            if (method_exists($controller, $action)) {
                //doing smt before calling an action
                $controller->beforeAction();
                // call an action
                $controller->$action();
            } else {
                Route::ErrorPage404();
            }
        }
    }

    static function ErrorPage404()
    {
        $controller = new DefaultController();
        $controller->action404();
    }
}