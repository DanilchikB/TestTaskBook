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
        $desc = false;
    }else if($_GET['asc']=='true'){
        $desc = false;
    }else{
        $desc = true;
    }
    $task = new TaskModel();
    $data = $task->getTasksSorted(($current-1)*3, 3, $sort, $desc);
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
        $desc = false;
    }else{
        $desc = true;
    }
    $page = (int)$_GET['page'];
    $sort = $_GET['sort'];
    $skip = ($page-1) * 3;
    $task = new TaskModel();
    $data = $task->getTasksSorted($skip, 3, $sort, $desc);
    return json_encode($data);
});

Router::add('/create', function(){
    
    $content = Array('title'=>'Create task');
    return View::render('create',$content);
});

Router::add('/update', function(){
    $status = null;
    if(!isset($_GET['id'])){
        echo 'No task selected';
        return;
    }
    if(isset($_GET['status'])){
        if($_GET['status']=='success'){
            $status = true;
        }else if($_GET['status']=='fail'){
            $status = false;
        }
    }
    if(!$_SESSION['auth']){
        header('Location: /');
    }
    $task = new TaskModel();
    $data = $task->getTask($_GET['id']);
    $content = Array('title'=>'Update task',
                     'task'=>$data,
                     'status'=>$status);
    return View::render('update',$content);
});

Router::add('/task/update',function(){
    if(!$_SESSION['auth']){
        header('Location: /');
    }
    $task=new TaskModel();
    if(isset($_POST['id'])){ 
        if(isset($_POST['completed']) && $_POST['completed']=='1'){
            $task->updateCompletedTask(1, $_POST['id']);
        }else{
            $task->updateCompletedTask(0, $_POST['id']);
        }
        if(isset($_POST['text']) && $_POST['text']!=''){
            $task->updateTextTask($_POST['text'], $_POST['id']);
        }
        header('Location: /update?id='.$_POST['id'].'&status=success');
    }else{
        header('Location: /update');
    }
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

