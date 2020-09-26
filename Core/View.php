<?php

namespace Core;


class View{
    public static function render(string $tamplate, ?array $data=null){
        $templatePath = dirname($_SERVER['DOCUMENT_ROOT']) . '/app/template/'.$tamplate.'.php';
        if (file_exists($templatePath)) {
            ob_start();
                if($data!==null){
                    extract($data);
                }
            include $templatePath; 
            return ob_get_clean();
        }
    }
}