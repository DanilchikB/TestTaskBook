<?php

namespace Core;

class Router{
    static private $urls=[];

    public static function add(string $url, callable $function){
        self::$urls[$url]=$function;
    }

    public static function runController(){
        $url=explode('?', $_SERVER['REQUEST_URI']);
        $controller = self::getController($url[0]);
        if($controller === null){
            echo "NotFound";
            return;
        }
        echo $controller();
    }


    private static function getController(string $url) : ?callable{
        foreach(self::$urls as $key => $value){
            if($key === $url){
                return $value;
            }
        }

        return null;
    }

}