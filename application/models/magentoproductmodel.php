<?php
namespace Cgi\Application\Models;

use Cgi\Application\Core\ModelAbstract;

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

    public static function getAllProducts()
    {
        $statement = self::$dbh->query("SELECT * FROM `product`");
        return $statement->fetchAll();

    }

    public function validate()
    {
        $fields = $this->data;
        if(strlen($fields['name']) > 65535) {
            return false;
        }
        if(strlen($fields['sku']) > 255) {
            return false;
        }
        if(($fields['is_saleable'] != '0') && ($fields['is_saleable'] != '1')) {
            return false;
        }
        if(strlen($fields['description']) > 65535) {
            return false;
        }
        if(!is_float($fields['final_price_without_tax']) && !((float)$fields['final_price_without_tax'] > 0) ) {
            return false;
        }
        return true;

    }


}