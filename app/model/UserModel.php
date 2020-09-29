<?php

namespace app\model;

use Core\Model;

class UserModel extends Model{
    public function getId(string $username, string $password):?int{
        $result = $this->queryOneRowReturn('SELECT id FROM admin WHERE username = ? AND password = ?',
        Array($username, $password));
        if($result===null){
            return null;
        }
        return (int)$result[0];
    }
}