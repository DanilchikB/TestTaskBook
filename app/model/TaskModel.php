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


    public function getTasksSorted(int $start,int $limit, string $sort, bool $DESC = false):?array{
        $columns = Array('username', 'email', 'completed', 'id');
        if(!in_array($sort, $columns, true)){
            return null;
        }
        $sortType = '';
        if($DESC){
            $sortType = 'DESC';
        }
        $params = Array($this->getParam(':limit',$limit),
                        $this->getParam(':skip',$start));
        $result = $this->queryAllReturnParams('SELECT id, username, email, text, completed, edit FROM tasks ORDER BY '.$sort.' '.$sortType.' LIMIT :skip, :limit', $params); 
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

    public function updateCompletedTask(int $completed, int $id){
        $task = Array($completed, $id);
        $status = $this->queryNoReturn(
            'UPDATE tasks SET completed = ? WHERE id = ?',$task
        ); 
        if(!$status){
            echo 'Problems with update complete task';
        }
    }
    public function updateEditTask(int $id, bool $edit){
        $task = Array($edit, $id);
        $status = $this->queryNoReturn(
            'UPDATE tasks SET edit = ? WHERE id = ?',$task
        ); 
        if(!$status){
            echo 'Problems with update complete task';
        }
    }

    public function getCountTasks():int{
        return (int)($this->queryOneRowReturn('SELECT count(*) as count FROM tasks'))['count'];
    }
    public function getTask($id):array{
        return $this->queryOneRowReturn('SELECT id, username, completed, email, text FROM tasks WHERE id = ?',Array($id));
    }

    public function checkTextTask(string $id, string $text){
        return $this->queryOneRowReturn('SELECT
                                        EXISTS(SELECT 1 FROM tasks WHERE id = ? and text = ?) AS check_text, 
                                        EXISTS(SELECT 1 FROM tasks WHERE id = ? and edit = true) AS check_edit',
        Array($id, $text,$id));
    }
    
}