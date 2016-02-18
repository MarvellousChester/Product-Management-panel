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
        $test = fwrite(
            $file, date('Y-m-d H:i:s') . ' ' . ' error: ' . $message . "\n"
        );
        if ($test) {
            echo 'Log was successfully written. <br />';
        } else {
            echo 'En error while writing the log. <br />';
        }
        fclose($file);
    }
}