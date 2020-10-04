<?php

namespace Core;

use Core\Setting;

use PDO;
use PDOException;

abstract class Model{
    //private $connectData = [];
    protected $dbconnection = null;

    
    protected function queryNoReturn(string $query, array $data):bool{
        if($query != '' || $query != null){
            $result = $this->openAndCloseConnection(function() use ($query, $data){
                    $preparation=$this->dbconnection->prepare($query);
                    if($preparation->execute($data)){
                        $preparation = null;
                        return true;
                    }else{
                        $preparation = null;
                        return false;
                    }
                }
            );
            return $result;
        }
        return false;
    }

    protected function queryOneRowReturn(string $query, array $data=null){
        if($query != '' || $query != null){
            $result = $this->openAndCloseConnection(function() use ($query, $data){
                    $preparation=$this->dbconnection->prepare($query);
                    $preparation->execute($data);
                    $result = $preparation->fetch(PDO::FETCH_ASSOC);
                    $preparation = null;
                    if(is_bool($result)){
                        return null;
                    }
                    return $result;
                }
            );
            return $result;
        }
        return null;
    }

    protected function queryAllReturn(string $query, array $data=null){
        if($query != '' || $query != null){
            $result = $this->openAndCloseConnection(function() use ($query, $data){
                    $preparation=$this->dbconnection->prepare($query);
                    $preparation->execute($data);
                    $result = $preparation->fetchAll(PDO::FETCH_ASSOC);
                    $preparation = null;
                    
                    return $result;
                }
            );
            return $result;
        }
        return null;
    }
    protected function queryAllReturnParams(string $query, array $params=null){
        if($query != '' || $query != null){
            $result = $this->openAndCloseConnection(function() use ($query, $params){
                    $preparation=$this->dbconnection->prepare($query);
                    if($params!=null){
                        foreach($params as $value){
                            $preparation->bindParam($value['sql_var'],$value['value'],$value['pdo_type']);
                        }
                    }
                    $preparation->execute();
                    $result = $preparation->fetchAll(PDO::FETCH_ASSOC);
                    $preparation = null;
                    
                    return $result;
                }
            );
            return $result;
        }
        return null;
    }


    
    protected function openAndCloseConnection($function){
        try {
            //$this->formationOfConnection();
            $this->dbconnection = new PDO('mysql:host='.Setting::$db['host'].';dbname='.Setting::$db['dbname'], 
                Setting::$db['user'], 
                Setting::$db['password']);

            $result = $function();

            $this->dbconnection = null;
            return $result;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    protected function getParam(string $paramName, string $value):array{
        return Array('sql_var' => $paramName, 
        'value'=>$value,
        'pdo_type'=>PDO::PARAM_INT);
    }
    /*private function formationOfConnection(){
        if($this->connectData === null){
            $settings = Setting::$db;
            $this->connectData = ['mysql:host'.$settings['host'].';
                                  port='.$settings['port'].';
                                  dbname='.$settings['dbname'].';
                                  user='.$settings['user'].';
                                  password='.$settings['password']];
        }
    }*/
}