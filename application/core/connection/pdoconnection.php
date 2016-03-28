<?php
namespace Cgi\Application\Core\Connection;

use Cgi\Application\Core\Settings;
use PDO;

class PdoConnection
{
    private $connectionData;
    /**
     * PdoConnection constructor.
     *
     * @param        $dataInputOption
     * @param        $connectionData
     *
     */
    public function __construct($dataInputOption, $connectionData = null)
    {
        switch ($dataInputOption) {
            case 'file':
                $this->connectionData
                    = Settings::getSettings('dbConnection');
                break;

            case 'directInput':
                $this->connectionData = $connectionData;
                break;

            default:
                echo 'Invalid connect configuration option';
                break;
        }
    }

    /**Establish a connection
     * @return PDO
     */
    public function establish()
    {
        $dbName = $this->connectionData['dbname'];
        $host = $this->connectionData['host'];
        $dsn = "mysql:dbname=$dbName;host=$host";

        $user = $this->connectionData['user'];
        $password = $this->connectionData['password'];
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $dbh = new PDO($dsn, $user, $password, $opt);
        return $dbh;
    }
}