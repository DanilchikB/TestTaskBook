<?php

use Core\Router;
use Core\View;
use Core\Form;
use app\model\TaskModel;


Router::add('/', function(){

    $task = new TaskModel();
    $data = $task->getTasks();

    $content = Array('title'=>'List tasks',
                     'tasks'=> $data);
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

