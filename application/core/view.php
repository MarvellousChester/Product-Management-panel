<?php
namespace Cgi\Application\Core;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:40
 */
class View
{

    function render($contentView, $templateView = 'templateView.php', $data = null)
    {

        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }


        include 'application/views/'.$templateView;
    }
}