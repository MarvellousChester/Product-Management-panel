<?php
namespace Cgi\Application\Models;

use Cgi\Application\Core\ModelAbstract;

class MagentoProductModel extends ModelAbstract
{
    const TEXT_MAX_LENGTH = 65535;
    const VARCHAR_MAX_LENGTH = 255;

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
        if (strlen($fields['name']) > self::TEXT_MAX_LENGTH) {
            return false;
        }
        if (strlen($fields['sku']) > self::VARCHAR_MAX_LENGTH) {
            return false;
        }
        if (($fields['is_saleable'] != '0')
            && ($fields['is_saleable'] != '1')
        ) {
            return false;
        }
        if (strlen($fields['description']) > self::TEXT_MAX_LENGTH) {
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
        $page,
        $sortAttribute,
        $sortOption
    )
    {
        $firstItem = abs($page * $itemsOnPage);

        $statement = self::$dbh->prepare("SELECT * FROM `product` ORDER BY ? ?
            LIMIT ?, ?");
        $statement->bindParam(1, $sortAttribute, \PDO::PARAM_STR);
        $statement->bindParam(2, $sortOption, \PDO::PARAM_STR);
        $statement->bindParam(3, $firstItem, \PDO::PARAM_INT);
        $statement->bindParam(4, $itemsOnPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function countProducts()
    {
        $statement = self::$dbh->query("SELECT count(*) FROM `product`");
        return $statement->fetch()['count(*)'];
    }
}