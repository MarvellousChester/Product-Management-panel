<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:50
 */
class MainController extends Controller
{
    function actionIndex()
    {
        $this->view->render('mainpageView.php', 'templateView.php');
    }

    function actionImportPage()
    {
        $this->view->render('importPageView.php', 'templateView.php');
    }

    function actionListingPage()
    {
        $this->view->render('listingPageView.php', 'templateView.php');
    }

    function actionEditingPage()
    {
        $this->view->render('editingPageView.php', 'templateView.php');
    }
}