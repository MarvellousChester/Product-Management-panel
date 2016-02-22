<?php
namespace Cgi;

require_once 'application/autoloader.php';

use Cgi\Application\Autoloader;
use Cgi\Application\Models\UserModel;

//A main entry point of the application
session_start();

$autoloader = new Autoloader();
$autoloader->register();

//One instance of user is required
$user = new UserModel(); //test

require_once 'application/bootstrap.php';
