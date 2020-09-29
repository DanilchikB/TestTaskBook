<?php

use Core\Router;
use Core\View;
use Core\Form;
use app\model;
use app\model\UserModel;

Router::add('/auth', function(){
    if(isset($_SESSION['auth']) && $_SESSION['auth']){
        header('Location: /');
    }
    $fail=null;
    if(array_key_exists('status', $_GET)){
        if($_GET['status']==='fail'){
            $fail = true;
        }
    }
    $content = Array('title'=>'Authorization', 
                     'fail'=>$fail);
    return View::render('auth',$content);
});

Router::add('/logout', function(){
    session_unset();
    header('Location: /auth');
});


Router::add('/user/auth', function(){
    var_dump($_POST);

    if(array_key_exists('username', $_POST) && 
        array_key_exists('password', $_POST)){
            $username = Form::linePreparation($_POST['username']);
            $password = trim($_POST['password']);
    }

    $userModel = new UserModel();
    $id = $userModel->GetId($username, $password);

    if($id !== null){
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $id;
        header('Location: /');
    }else{
        header('Location: /auth?status=fail');
    }
    
});