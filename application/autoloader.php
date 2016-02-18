<?php
namespace Cgi\Application;
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.02.16
 * Time: 10:09
 */
class Autoloader
{
    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    protected function autoload($className)
    {
        $pathParts = explode('\\', strtolower($className));
        unset($pathParts[array_search('Cgi', $pathParts)]);
        $fileName = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . implode(
                DIRECTORY_SEPARATOR, $pathParts
            ) . '.php';
        if (file_exists($fileName)) {
            require_once $fileName;
            if (!class_exists($className) && !interface_exists($className)) {
                //throw new \Exception;
            }
        } else {
            //throw new \Exception;
        }

        return true;
    }

}