<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 16.02.16
 * Time: 16:40
 */
class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function render($contentView, $templateView, $data = null)
    {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */

        include 'application/views/'.$templateView;
    }
}