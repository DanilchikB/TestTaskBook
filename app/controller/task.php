<?php

use Core\Router;
use Core\View;
use Core\Model;


Router::add('/', function(){

    $content = Array('title'=>'List tasks');
    return View::render('index',$content);
});

Router::add('/create', function(){
    
    $content = Array('title'=>'List tasks');
    return View::render('create',$content);
});
Router::add('/task/create', function(){
    var_dump($_POST);
});


    // Router::add('/test', function(){
    //     //phpinfo();
    //     $model=new Model();
    //     $result = $model->queryAllReturn('SELECT * FROM admin WHERE id = ?', 
    //             array(1));
    //     return var_dump($result);
    // });
    // if(array_key_exists('status', $_GET)){
    //     if($_GET['status']=='success'){
    //         $checkStatus = true;
    //     }
    // }