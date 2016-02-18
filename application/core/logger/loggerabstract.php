<?php
namespace Cgi\Application\Core\Logger;

/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 08.02.16
 * Time: 14:03
 */


abstract class LoggerAbstract
{
    const ERROR = 'error';
    const WARNING = 'warning';
    const NOTICE = 'notice';

    public function error($message)
    {
        $this->writeLog($message, self::ERROR);
    }

    public function warning($message)
    {
        $this->writeLog($message, self::WARNING);
    }

    public function notice($message)
    {
        $this->writeLog($message, self::NOTICE);
    }

    abstract protected function writeLog($message, $messageType);
}
