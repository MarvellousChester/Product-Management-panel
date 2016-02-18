<?php
namespace Cgi;

require_once 'application/autoloader.php';

use Cgi\Application\Autoloader;
use Cgi\Application\Models\UserModel;
use Cgi\Application\Core\Settings;

session_start();

$autoloader = new Autoloader();
$autoloader->register();

//One instance of user is required
$user = new UserModel();

require_once 'application/bootstrap.php';
