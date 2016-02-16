<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:39
 */
class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex()
    {
    }
}