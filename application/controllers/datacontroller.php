<?php
namespace Cgi\Application\Controllers;

use Cgi\Application\Core\Controller;
use Cgi\Application\Core\Settings;
use Cgi\Application\Models\MagentoProductModel;

class DataController extends Controller
{
    /**Import products using Magento REST API and save them in the database
     *
     */
    public function actionImport()
    {
        $report = "";
        $productMas = [];
        if (isset($_GET["url"]) && $_GET["url"] != null) {
            //forming the request url
            $url = $_GET["url"] . 'api/rest/products?page=1&limit=100';
            //making a request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            //If request failed
            if ($output == false) {
                echo 'An error was encountered during the import. Please check
                inputted url';
            }
            else {
                $productMas = json_decode($output, true);
            }

            foreach ($productMas as $product) {
                $entry = new MagentoProductModel();
                $entry->loadBy('sku', $product['sku']);
                $entry->saveProduct($product);
                //If the product is not in the local database
                if ($entry->getId() == null) {
                    $report .= 'Added new product with SKU: ' . $product['sku']
                        . '<br />';
                } else {
                    $report .= 'Updated a product with SKU: ' . $product['sku']
                        . '<br />';
                }
            }
        } else {
            echo 'Please enter url address';
        }
        $this->view->render(
            'importPageView.php', 'templateView.php', ['report' => $report]
        );
    }

    /**Display products
     *
     */
    public function actionList()
    {
        $itemsOnPage = (int)Settings::getSettings('productsPerPage');
        $page = 0;
        $sortAttribute = 'product_id';
        $sortOption = 'ASC';

        if (isset($_GET["page"])) {
            $page = $_GET["page"] - 1;
        }
        if (isset($_GET["sortBy"])) {
            $sortAttribute = strip_tags($_GET["sortBy"]);
            $sortOption = strip_tags($_GET["option"]);
        }

        $products = MagentoProductModel::getProducts(
            $itemsOnPage,
            $page,
            $sortAttribute,
            $sortOption
        );

        $amountOfProducts = MagentoProductModel::countProducts();
        $amountOfPages = ceil($amountOfProducts / $itemsOnPage);
        $this->view->render(
            'listingPageView.php', 'templateView.php',
            ['products' => $products, 'amountOfPages' => $amountOfPages,
             'page'     => $page + 1]
        );
    }

    /**Edit a single product
     *
     */
    public function actionEdit()
    {
        $id = (int)$_GET["id"];
        $product = new MagentoProductModel();
        $load = $product->loadBy('product_id', $id);
        if($load == false) {
            header("Location: http://pmpanel.loc/data/list");
            exit();
        }
        if (isset($_POST['sku'])) {
            foreach ($product->getFields() as $field) {
                if (isset($_POST[$field])) {
                    $product->set($field, $_POST[$field]);
                }
            }
            if ($product->validate()) {
                $product->save();
                header("Location: http://pmpanel.loc/data/list");
            } else {
                echo 'Invalid data!';
            }
        }
        $this->view->render(
            'editingFormView.php', 'templateView.php', $product
        );
    }
}