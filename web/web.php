<?php

namespace Core;

//show errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');

//include autoload
require_once dirname(__DIR__).'/Core/autoload.php';

use Core\Router;
use Core\Controller;
use Core\Setting;

Setting::initSetting();
$controller = new Controller();
$controller->initControllers(Setting::$app['path_app'].'/app/controller/');


Router::runController();