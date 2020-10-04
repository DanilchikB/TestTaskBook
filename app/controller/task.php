<?php

use Core\Router;
use Core\View;
use Core\Form;
use app\model\TaskModel;
use app\PageElement\Pagination;


Router::add('/', function(){
    if(!array_key_exists('page', $_GET)){
    //    header('Location: /?page=1');
        $current=1;
    }else{
        $current=(int)$_GET['page'];
    }
    if(!array_key_exists('sort', $_GET)){
        $sort = 'id';
    }else{
        $sort = $_GET['sort'];
    }
    if(!array_key_exists('asc', $_GET)){
        $asc = true;
    }else if($_GET['asc']=='true'){
        $asc = false;
    }else{
        $asc = true;
    }
    $task = new TaskModel();
    $data = $task->getTasksSorted(($current-1)*3, 3, $sort, $asc);
    $pagination = new Pagination(3);
    $countPages = $pagination->getCountPages($task->getCountTasks());
    $content = Array('title'=>'List tasks',
                     'tasks'=> $data,
                     'countPages'=> $countPages,
                     'current'=>$current);

    return View::render('index',$content);
});

Router::add('/tasks', function():string{
    if($_GET['asc']=='true'){
        $asc = false;
    }else{
        $asc = true;
    }
    $page = (int)$_GET['page'];
    $sort = $_GET['sort'];
    $skip = ($page-1) * 3;
    $task = new TaskModel();
    $data = $task->getTasksSorted($skip, 3, $sort, $asc);
    return json_encode($data);
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

