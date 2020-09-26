<?php

spl_autoload_register(function($class_name){
    
    $dir = dirname($_SERVER['DOCUMENT_ROOT']) . '/' .str_replace('\\', '/', $class_name) . '.php';
    require_once $dir;
});




