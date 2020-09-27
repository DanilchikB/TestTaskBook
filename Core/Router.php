<?php

namespace Core;

use Core\Setting;

class Router{
    private static $urls = [];
    private static $nowUrl = [];

    public static function add(string $url, callable $function){
        self::$urls[$url]=$function;
    }

    public static function runController(){
        $controller = self::getController(self::$nowUrl[0]);
        if($controller === null){
            echo "NotFound";
            return;
        }
        echo $controller();
    }
    public static function checkStaticFile(): bool {
        //echo Setting::$app['path_app'].'/web'.self::$nowUrl[0];
        if(self::getController(self::$nowUrl[0]) === null && 
            file_exists(Setting::$app['path_app'].'/web'.self::$nowUrl[0]) &&
            strpos(self::$nowUrl[0], 'public')!==false
            ){
            //echo Setting::$app['path_app'].self::$nowUrl[0];
            return true;
        }
        return false;
    }
    public static function getNowUrl(){
        self::$nowUrl=explode('?', $_SERVER['REQUEST_URI']);
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