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


}