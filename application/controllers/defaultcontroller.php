<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Models\UserModel;
/**
 *Default controller of the application
 */

class DefaultController extends Controller
{
    function actionIndex()
    {
        $user = UserModel::findBy('email', $_SESSION["email"]);
        $name = $user->get('first_name');
        $this->view->render(
            'mainpageView.php', 'templateView.php', ['firstName' => $name]
        );
    }
    function action404()
    {
        $this->view->render('404View.php', 'templateView.php');
    }

}