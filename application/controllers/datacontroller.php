<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Models\MagentoProductModel;

class DataController extends Controller
{
    public function actionImport()
    {
        $report = "";
        if(isset($_GET["url"]) && $_GET["url"] != null)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $_GET["url"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $productMas = json_decode($output, true);

            foreach($productMas as $product ) {
                $entry = new MagentoProductModel();
                $entry->loadBy('sku', $product['sku']);
                if ($entry->getId() == null) {
                    $entry->saveProduct($product);
                    $report .= 'Added new product with SKU: ' . $product['sku']
                        . '<br />';
                }
            }


        }
        else {
            echo 'Please enter url address';
        }
        $this->view->render('importPageView.php', 'templateView.php', ['report' => $report]);

    }

    public function actionList()
    {
        $products = MagentoProductModel::getAllProducts();
        if (isset($_GET["sortBy"])) {
            $sortAttribute = $_GET["sortBy"];
            $sortOption = $_GET["option"];
            $array = [];
            foreach ($products as $key => $product) {
                $array[$key] = $product[$sortAttribute];
            }
            if ($sortOption == 'ASC') {
                array_multisort($array, SORT_ASC, SORT_REGULAR, $products);
            } elseif ($sortOption == 'DESC') {
                array_multisort($array, SORT_DESC, SORT_REGULAR, $products);
            }
        }
        $page = 0;

        if (isset($_GET["page"])) {
            $page = $_GET["page"];

        }

        $itemsOnPage = 10;
        $amountOfPages = ceil(count($products) / $itemsOnPage);

        $pagination = false;
        if (count($products) > $itemsOnPage) {
            $pagination = true;
        }
        if ($pagination) {
            $productsSplited = array_chunk($products, $itemsOnPage);
            $this->view->render(
                'listingPageView.php', 'templateView.php',
                ['products' => $productsSplited[$page], 'page' => $page, 'amountOfPages' => $amountOfPages]
            );
        } else {
            $this->view->render(
                'listingPageView.php', 'templateView.php',
                ['products' => $products, 'page' => $page, 'amountOfPages' => $amountOfPages]
            );
        }


    }

    public function actionEdit()
    {
        $id = $_GET["id"];
        $product = new MagentoProductModel();
        $product->loadBy('product_id', $id);
        if(isset($_POST['sku'])) {
            foreach ($product->getFields() as $field) {
                if (isset($_POST[$field])) {
                    $product->set($field, $_POST[$field]);
                }
            }
            if($product->validate()) {
                $product->save();
                header("Location: http://pmpanel.loc/data/list");
            }
            else echo 'Invalid data!';

        }
        $this->view->render('editingFormView.php', 'templateView.php', $product);

    }

}