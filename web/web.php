<?php

namespace Core;

//show errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');

//include autoload
require_once dirname($_SERVER['DOCUMENT_ROOT']).'/Core/autoload.php';

use Core\Router;
use Core\Controller;


$controller = new Controller();
$controller->initControllers(dirname($_SERVER['DOCUMENT_ROOT']).'/app/controller/');


Router::runController();