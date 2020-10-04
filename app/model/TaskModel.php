<?php

namespace app\model;

use ArrayAccess;
use Core\Model;
use PDO;

class TaskModel extends Model{

    public function createTask(array $task){
        $status = $this->queryNoReturn('INSERT INTO tasks(username, email, text) VALUES (?,?,?)',$task); 
        if(!$status){
            echo 'Problems with task assignment';
        }
    }

    /*public function getTasks(int $limit):array{
        $params = Array($this->getParam(':limit',$limit));
        $result = $this->queryAllReturnParams('SELECT id, username, email, text, completed FROM tasks LIMIT :limit', $params); 
        return $result;
    }*/

    public function getTasksSorted(int $start,int $limit, string $sort, bool $DESC = false):?array{
        $columns = Array('username', 'email', 'comleted');
        if(!in_array($sort, $columns, true)){
            return null;
        }
        $sortType = '';
        if($DESC){
            $sortType = 'DESC';
        }
        $params = Array($this->getParam(':limit',$limit),
                        $this->getParam(':skip',$start));
        $result = $this->queryAllReturnParams('SELECT id, username, email, text, completed FROM tasks ORDER BY '.$sort.' '.$sortType.' LIMIT :skip, :limit', $params); 
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

    public function getCountTasks():int{
        return (int)($this->queryOneRowReturn('SELECT count(*) as count FROM tasks'))['count'];
    }
    
}