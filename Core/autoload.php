<?php

$path = (require_once dirname(__DIR__).'/app/settings/app.php')['path_app'];
spl_autoload_register(function($class_name) use ($path){
    $dir =  $path . '/' .str_replace('\\', '/', $class_name) . '.php';
    require_once $dir;
});
unset($path);




