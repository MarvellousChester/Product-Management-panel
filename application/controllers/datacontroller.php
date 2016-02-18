<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Core\Settings;

class DataController extends Controller
{
    public function actionImport()
    {
        if(isset($_GET["url"]) && $_GET["url"] != null)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $_GET["url"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $productMas = json_decode($output, true);

            foreach($productMas as $product ) {
                var_dump($product);
            }


            //var_dump($productMas);

        }
        else {
            echo 'Please enter url address';
        }

    }
}