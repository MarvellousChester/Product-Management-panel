<?php
namespace Cgi\Application\Models;

use Cgi\Application\Core\ModelAbstract;
use Cgi\Application\Core\Settings;

class MagentoProductModel extends ModelAbstract
{

    protected function getTableName()
    {
        return 'product';
    }

    protected function beforeSave()
    {
        if (!$this->isLoaded) {
            $this->data['updated'] = date('Y-m-d H:i:s');
        }
    }

    public function saveProduct($product)
    {
        foreach ($this->getFields() as $field) {
            if($field!='updated') {
                $this->set($field, $product[$field]);
            }
        }
        return $this->save();
    }


    /**Check if input data is correct
     * @return bool
     */
    public function validate()
    {
        $fields = $this->data;
        if (strlen($fields['name']) > 65535) {
            return false;
        }
        if (strlen($fields['sku']) > 255) {
            return false;
        }
        if (($fields['is_saleable'] != '0')
            && ($fields['is_saleable'] != '1')
        ) {
            return false;
        }
        if (strlen($fields['description']) > 65535) {
            return false;
        }
        if (!is_float($fields['final_price_without_tax'])
            && !((float)$fields['final_price_without_tax'] > 0)
        ) {
            return false;
        }
        return true;
    }

    /**get products from a database
     * @param        $itemsOnPage
     * @param int    $page
     * @param string $sortAttribute
     * @param string $sortOption
     *
     * @return array
     */
    public static function getProducts(
        $itemsOnPage,
        $page = 0,
        $sortAttribute = 'product_id',
        $sortOption = 'ASC'
    )
    {
        if (isset($_GET["page"])) {
            $page = $_GET["page"] - 1;
        }
        if (isset($_GET["sortBy"])) {
            $sortAttribute = $_GET["sortBy"];
            $sortOption = $_GET["option"];
        }
        $firstItem = abs($page * $itemsOnPage);

        $statement = self::$dbh->query(
            "SELECT * FROM `product` ORDER BY $sortAttribute $sortOption
            LIMIT $firstItem, $itemsOnPage"
        );
        return $statement->fetchAll();
    }

    public static function countProducts()
    {
        $statement = self::$dbh->query("SELECT count(*) FROM `product`");
        return $statement->fetch()['count(*)'];
    }
}