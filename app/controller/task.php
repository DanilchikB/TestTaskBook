<?php

use Core\Router;
use Core\View;
use Core\Model;


Router::add('/', function(){
    return View::render('index');
});

Router::add('/test', function(){
    //phpinfo();
    $model=new Model();
    $result = $model->queryOneRowReturn('SELECT username FROM admin WHERE id = ?', 
            array(1));
    return var_dump($result);
});