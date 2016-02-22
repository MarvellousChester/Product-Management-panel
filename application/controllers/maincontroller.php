<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Models\UserModel;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:50
 */
class MainController extends Controller
{

    public function actionIndex()
    {
        $user = UserModel::findBy('email', $_SESSION["email"]);
        $name = $user->get('first_name');
        $this->view->render(
            'mainpageView.php', 'templateView.php', ['first_name' => $name]
        );
    }

    public function actionImportPage()
    {
        $this->view->render('importPageView.php', 'templateView.php');
    }

    public function actionListingPage()
    {
        $this->view->render('listingPageView.php', 'templateView.php');
    }

    public function actionLogin()
    {
        //If email and password were sent
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            //If such user exists
            if (UserModel::validate($_POST["email"], $_POST["password"])) {
                //set user authorization
                $_SESSION["isAuth"] = true;
                //Write user's email to the session
                $_SESSION["email"] = $_POST["email"];
                //Redirect to the main page
                header("Location: http://pmpanel.loc");
            } else {
                echo 'Incorrect login or password';
            }
        }
        //if user wasn't log in
        $this->view->render('loginFormView.php', 'templateView.php');
    }

    public function actionLogout()
    {
        $_SESSION = array();
        session_destroy();
        header("Location: http://pmpanel.loc");
    }


}