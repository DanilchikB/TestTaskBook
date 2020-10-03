<?php

namespace app\model;

use ArrayAccess;
use Core\Model;

class TaskModel extends Model{
    public function createTask(array $task){
        $status = $this->queryNoReturn('INSERT INTO tasks(username, email, text) VALUES (?,?,?)',$task); 
        if(!$status){
            echo 'Problems with task assignment';
        }
    }

    public function getTasks():array{
        $result = $this->queryAllReturn('SELECT username, email, text, completed FROM tasks'); 
        return $result;
    }

    public function updateTextTask(string $text, int $id){
        $task = Array($text, $id);
        $status = $this->queryNoReturn(
            'UPDATE tasks SET text = ? WHERE id = ?',$task
        ); 
        if(!$status){
            echo 'Problems with update text task';
        }
    }

    public function updateCompletedTask(bool $completed, int $id){
        $task = Array($completed, $id);
        $status = $this->queryNoReturn(
            'UPDATE tasks SET completed = ? WHERE id = ?',$task
        ); 
        if(!$status){
            echo 'Problems with update complete task';
        }
    }
}