<?php
namespace Core;

class Setting{
    public static $db=[];
    public static $app=[];

    public static function initSetting(){
        self::$db=require dirname(__DIR__).'/app/settings/db.php';
        self::$app=require dirname(__DIR__).'/app/settings/app.php';
    }
}