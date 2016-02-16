<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:59
 */

class defaultController extends Controller
{
    function actionIndex()
    {
        $this->view->render('mainpageView.php', 'templateView.php');
    }

}