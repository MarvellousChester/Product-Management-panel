<?php
namespace Cgi\Application\Core;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:39
 */
class Controller
{

    public $model;
    public $view;

    protected $actionName;

    public function __construct()
    {
        $this->view = new View();
    }

    public function beforeAction()
    {
        if($this->actionName != 'actionlogin'){
            if(!$_SESSION["isAuth"]) {
                header("Location: http://pmpanel.loc/main/login");
            }
        }
    }

    public function actionIndex()
    {
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionId
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

}