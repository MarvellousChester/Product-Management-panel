<?php
namespace Cgi\Application\Core\Logger;

/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 11.02.16
 * Time: 17:07
 */
class FileLogger extends LoggerAbstract
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    protected function writeLog($message, $messageType)
    {
        $file = fopen($this->filename, 'a+');
        fwrite(
            $file, date('Y-m-d H:i:s') . ' ' . ' error: ' . $message . "\n"
        );
        fclose($file);
    }
}