<?php


use Core\Router;
use Core\View;


Router::add('/test', function(){
    return View::render('index');
});

Router::add('/test1', function(){
    return 'test1';
});

