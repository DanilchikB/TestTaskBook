<?php

namespace app\model;

use Core\Model;

class TaskModel extends Model{
    public function createTask(array $task){
        $status = $this->queryNoReturn('INSERT INTO tasks(username, email, text) VALUES (?,?,?)',$task); 
        if(!$status){
            echo 'Problems with task assignment';
        }
    }

    public function getTasks():array{
        $result = $this->queryAllReturn('SELECT username, email, text FROM tasks'); 
        return $result;
    }
}