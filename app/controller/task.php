<?php

use Core\Router;
use Core\View;
use Core\Form;


Router::add('/', function(){

    $content = Array('title'=>'List tasks',
                     );
    return View::render('index',$content);
});

Router::add('/create', function(){
    
    $content = Array('title'=>'Create task');
    return View::render('create',$content);
});
Router::add('/task/create', function(){
    $username = Form::linePreparation($_POST['username']);
    $email = Form::linePreparation($_POST['email']);
    $text = Form::linePreparation($_POST['text']);
    if($username == ''){
        
    }

    
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