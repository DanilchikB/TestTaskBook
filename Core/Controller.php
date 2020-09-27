<?php
namespace Core;

use Core\Setting;

class Controller{
    private $files=[];


    public function initControllers(string $dir){
        $this->getControllers($dir);
        foreach($this->files as $value){
            require_once Setting::$app['path_app'].'/app/controller/'.$value;
        } 
    }

    private function getControllers(string $dir){
        $this->files = scandir($dir);
        if(!$this->files){
            echo "Not a directory";
            return;
        }
        unset($this->files[0], $this->files[1]);
    }


}