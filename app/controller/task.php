<?php

use Core\Router;
use Core\View;
use Core\Form;
use app\model\TaskModel;


Router::add('/', function(){

    $task = new TaskModel();
    echo '<pre>';
    var_dump($task->getTasks());
    echo '</pre>';

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
    if($username == '' && $email == '' && $text == ''){
        return 'fail';
    }
    $task = new TaskModel();
    $task->createTask(Array($username, $email, $text));
    header('Location: /');
    
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