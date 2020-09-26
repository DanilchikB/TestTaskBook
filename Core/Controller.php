<?php
namespace Core;

class Controller{
    private $files=[];


    public function initControllers(string $dir){
        $this->getControllers($dir);
        foreach($this->files as $value){
            require_once dirname($_SERVER['DOCUMENT_ROOT']).'/app/controller/'.$value;
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