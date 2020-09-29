<?php

namespace Core;

use Core\Setting;

class View{
    public static function render(string $tamplate, ?array $data=null, 
                        string $baseTemplate='base'){
        $tamplatePath = Setting::$app['path_app'] . '/app/template/';
        $baseTemplatePath = $tamplatePath.$baseTemplate.'.php';
        $templatePath = $tamplatePath.$tamplate.'.php';
        $content = '';
        if($data!==null){
            extract($data);
        }
        if (file_exists($templatePath)) {
            ob_start();
                
            include $templatePath; 
            $content = ob_get_clean();
        } 
        if(file_exists($baseTemplatePath)){
            ob_start();
                
            include $baseTemplatePath; 
            return ob_get_clean();
        }else{
            return $content;
        }
    }

}