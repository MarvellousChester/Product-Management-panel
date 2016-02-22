<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Models\UserModel;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:59
 */

class DefaultController extends Controller
{
    function actionIndex()
    {
        $user = UserModel::findBy('email', $_SESSION["email"]);
        $name = $user->get('first_name');
        $this->view->render('mainpageView.php', 'templateView.php', ['first_name' => $name]);
    }
    function action404()
    {
        $this->view->render('404View.php', 'templateView.php');
    }

}