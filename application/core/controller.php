<?php
namespace Cgi\Application\Core;
/**
 * Base controller class
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
        $guestActionsList = Settings::getSettings('guestActionsList');
        $redirectLocation = Settings::getSettings('unAuthRedirectPage');
        //If it's not an action for guests
        if(!in_array($this->actionName, $guestActionsList)){
            if(!$_SESSION["isAuth"]) {
                header("Location: $redirectLocation");
                exit;
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