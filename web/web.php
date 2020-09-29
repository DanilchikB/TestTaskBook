<?php

namespace Core;

session_start();
//show errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');

//include autoload
require_once dirname(__DIR__).'/Core/autoload.php';

use Core\Router;
use Core\Controller;
use Core\Setting;

Setting::initSetting();
Router::getNowUrl();

$controller = new Controller();
$controller->initControllers(Setting::$app['path_app'].'/app/controller/');


if(Setting::$app['isPHPDevelopmentServer']){
    if(Router::checkStaticFile()){
        //echo 'yes';
        return false;
    }
}
Router::runController();